<?php declare(strict_types=1);

namespace Becklyn\DiginightsApi;

use Becklyn\DiginightsApi\Event\CreateEventRequest;
use Becklyn\DiginightsApi\Event\Event;
use Becklyn\DiginightsApi\Event\EventNotFoundException;
use Becklyn\DiginightsApi\Event\ListEventsResponse;
use Becklyn\DiginightsApi\Location\Location;
use Becklyn\DiginightsApi\Location\LocationNotFoundException;
use Becklyn\DiginightsApi\SeatingChart\SeatCategory;
use Becklyn\DiginightsApi\SeatingChart\SeatingChart;
use Becklyn\DiginightsApi\SeatingChart\SeatingChartNotFoundException;
use Becklyn\DiginightsApi\TicketSale\TicketSale;
use Becklyn\DiginightsApi\TicketSale\TicketSaleNotFoundException;
use Becklyn\DiginightsApi\TicketType\AddTicketTypeRequest;
use Becklyn\DiginightsApi\TicketType\TicketType;

class Api
{
    private Connection $connection;
    private Client $client;

    public function __construct(Connection $connection, Client $client)
    {
        $this->connection = $connection;
        $this->client = $client;
    }

    /**
     * @throws AuthorizationFailedException
     * @throws ApiException
     */
    public function listEvents(int $page = 1) : ListEventsResponse
    {
        $response = $this->client->get($this->connection, "/event/list/upcoming/{$page}");

        $this->throwExceptionOnFailedRequest($response);

        return new ListEventsResponse(
            \array_map(fn(array $event) => $this->deserializeEvent($event), $response->data()['events']),
            $response->data()['page'],
            $response->data()['max_results']
        );
    }

    /**
     * @throws ApiException
     * @throws AuthorizationFailedException
     * @throws ValidationException
     */
    private function throwExceptionOnFailedRequest(ClientResponse $response, ?string $resourceNotFoundExceptionFqn = null) : void
    {
        if (!$response->isSuccessful()) {
            if ($response->isAuthorizationFailed()) {
                throw new AuthorizationFailedException($response->error());
            }

            if (null !== $resourceNotFoundExceptionFqn && $response->isNotFound()) {
                throw new $resourceNotFoundExceptionFqn($response->error());
            }

            if ($response->isBadRequest()) {
                throw new ValidationException(\json_encode($response->validationErrors()));
            }

            throw new ApiException(\json_encode($response->content()));
        }
    }

    private function deserializeEvent(array $eventData) : Event
    {
        $locationData = $eventData['location'] ?? null;
        $ticketSaleData = $eventData['ticket_sale'] ?? null;
        $location = null !== $locationData ? $this->deserializeLocation($locationData) : null;
        $ticketSale = null !== $ticketSaleData ? $this->deserializeTicketSale($ticketSaleData) : null;

        return new Event(
            $eventData['uuid'],
            $eventData['name'],
            new \DateTimeImmutable($eventData['date_start']),
            new \DateTimeImmutable($eventData['date_end']),
            $eventData['name'],
            $eventData['slug'],
            $eventData['url'],
            $location,
            $ticketSale
        );
    }

    private function deserializeLocation(array $locationData) : Location
    {
        $seatingCharts = [];

        if (\array_key_exists('seating_charts', $locationData) && \is_array($locationData['seating_charts'])) {
            $seatingCharts = \array_map(
                fn(array $seatingChart) => $this->deserializeSeatingChart($seatingChart),
                $locationData['seating_charts']
            );
        }

        return new Location(
            $locationData['uuid'],
            $locationData['name'],
            $seatingCharts
        );
    }

    private function deserializeSeatingChart(array $seatingChartData) : SeatingChart
    {
        $seatCategories = [];

        if (\array_key_exists('categories', $seatingChartData) && \is_array($seatingChartData['categories'])) {
            $seatCategories = \array_map(
                fn(array $seatCategory) => new SeatCategory($seatCategory['key'], $seatCategory['label']),
                $seatingChartData['categories']
            );
        }

        $thumbnail = null;

        if (\array_key_exists('thumbnail', $seatingChartData)) {
            $thumbnail = $seatingChartData['thumbnail'];
        }

        return new SeatingChart(
            $seatingChartData['chart_key'],
            $seatingChartData['name'],
            $seatCategories,
            $thumbnail
        );
    }

    private function deserializeTicketSale(array $ticketSaleData) : TicketSale
    {
        $ticketTypes = [];

        if (\array_key_exists('ticket_types', $ticketSaleData) && \is_array($ticketSaleData['ticket_types'])) {
            $ticketTypes = \array_map(fn(array $ticketType) => $this->deserializeTicketType($ticketType), $ticketSaleData['ticket_types']);
        }

        $seatingChartKey = null;

        if (\array_key_exists('seating_chart', $ticketSaleData) &&
            \is_array($ticketSaleData['seating_chart']) &&
            \array_key_exists('chart_key', $ticketSaleData['seating_chart']) &&
            !empty($ticketSaleData['seating_chart']['chart_key'])
        ) {
            $seatingChartKey = $ticketSaleData['seating_chart']['chart_key'];
        }

        return new TicketSale(
            $ticketSaleData['uuid'],
            $ticketSaleData['is_active'],
            new \DateTimeImmutable($ticketSaleData['sales_start']),
            new \DateTimeImmutable($ticketSaleData['sales_end']),
            $ticketSaleData['url'],
            $ticketTypes,
            $seatingChartKey
        );
    }

    private function deserializeTicketType(array $ticketTypeData) : TicketType
    {
        return new TicketType($ticketTypeData['name'], $ticketTypeData['is_active'], $ticketTypeData['price']);
    }

    /**
     * @throws ApiException
     * @throws AuthorizationFailedException
     * @throws EventNotFoundException
     */
    public function getEvent(string $uuid) : Event
    {
        $response = $this->client->get($this->connection, "/event/{$uuid}/detail");

        $this->throwExceptionOnFailedRequest($response, EventNotFoundException::class);

        return $this->deserializeEvent($response->data()['event']);
    }

    /**
     * @throws ApiException
     * @throws AuthorizationFailedException
     * @throws TicketSaleNotFoundException
     */
    public function getTicketSale(string $uuid) : TicketSale
    {
        $response = $this->client->get($this->connection, "/ticket-sale/{$uuid}/detail");

        $this->throwExceptionOnFailedRequest($response, TicketSaleNotFoundException::class);

        return $this->deserializeTicketSale($response->data()['ticket_sale']);
    }

    /**
     * @throws ApiException
     * @throws AuthorizationFailedException
     * @throws SeatingChartNotFoundException
     */
    public function getSeatingChart(string $key) : SeatingChart
    {
        $response = $this->client->get($this->connection, "/seating-chart/{$key}/detail");

        $this->throwExceptionOnFailedRequest($response, SeatingChartNotFoundException::class);

        return $this->deserializeSeatingChart($response->data()['seating_chart']);
    }

    /**
     * @throws ApiException
     * @throws AuthorizationFailedException
     * @throws LocationNotFoundException
     */
    public function getLocation(string $uuid) : Location
    {
        $response = $this->client->get($this->connection, "/location/{$uuid}/seating-charts");

        $this->throwExceptionOnFailedRequest($response, LocationNotFoundException::class);

        return $this->deserializeLocation($response->data()['location']);
    }

    /**
     * @throws ApiException
     * @throws AuthorizationFailedException
     * @throws ValidationException
     */
    public function createEvent(CreateEventRequest $request) : Event
    {
        $postData = [
            'event[name]' => $request->name(),
            'event[category]' => $request->category()->asString(),
            'event[date_start]' => $request->dateStart()->format('Y-m-d H:i:s'),
            'event[date_end]' => $request->dateEnd()->format('Y-m-d H:i:s'),
            'event[location_id]' => $request->locationId(),
            'event[age_from]' => $request->ageFrom()->asString(),
            'ticket_general[contingent_overall]' => $request->ticketSale()->overallContingent(),
            'ticket_general[age_from]' => $request->ticketSale()->ageFrom()->asString(),
            'ticket_general[is_active]' => (int) $request->ticketSale()->isActive(),
            'ticket_general[company]' => $request->ticketSale()->company(),
            'ticket_general[street]' => $request->ticketSale()->street(),
            'ticket_general[zip_code]' => $request->ticketSale()->zip(),
            'ticket_general[city]' => $request->ticketSale()->city(),
            'ticket_general[contact_name]' => $request->ticketSale()->contactName(),
            'ticket_general[contact_phone]' => $request->ticketSale()->contactPhone(),
            'ticket_general[contact_email]' => $request->ticketSale()->contactEmail(),
            'ticket_general[vat_no]' => $request->ticketSale()->vatNo(),
            'ticket_general[iban]' => $request->ticketSale()->iban(),
            'ticket_general[bic]' => $request->ticketSale()->bic(),
            'ticket_general[sales_start]' => $request->ticketSale()->salesStart()->format('Y-m-d H:i:s'),
            'ticket_general[sales_end]' => $request->ticketSale()->salesEnd()->format('Y-m-d H:i:s'),
        ];

        if ($request->seatingChartKey()) {
            $postData['seating_chart_assign[seating_chart]'] = $request->seatingChartKey();
        }

        $response = $this->client->post($this->connection, '/event-with-ticket-sale/create', $postData);

        $this->throwExceptionOnFailedRequest($response);

        return $this->deserializeEvent($response->data()['event']);
    }

    /**
     * @throws ApiException
     * @throws AuthorizationFailedException
     * @throws ValidationException
     */
    public function addTicketType(AddTicketTypeRequest $request) : TicketType
    {
        $postData = [
            'ticket_general[uuid]' => $request->ticketSaleUuid(),
            'ticket_type[name]' => $request->name(),
            'ticket_type[different_sales_period]' => (int) $request->differentSalesPeriod(),
            'ticket_type[price]' => $request->price(),
            'ticket_type[seat_categories][seat_categories]' => $request->seatCategories(),
        ];

        if ($request->differentSalesPeriod()) {
            $postData['ticket_type[sales_start]'] = $request->salesStart()->format('Y-m-d H:i:s');
            $postData['ticket_type[sales_end]'] = $request->salesEnd()->format('Y-m-d H:i:s');
        }

        $response = $this->client->post($this->connection, '/ticket-type/add', $postData);

        $this->throwExceptionOnFailedRequest($response);

        return $this->deserializeTicketType($response->data()['ticket_type']);
    }
}
