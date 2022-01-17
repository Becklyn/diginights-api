Diginights API
==============

A PHP abstraction of the Diginights ticket system API.


Instructions
------------
The `Becklyn\DiginightsApi\Api` class is the central entry point for interaction with the Diginights webservice. All of its public methods represent individual API endpoints. It needs to be constructed with a `Becklyn\DiginightsApi\Connection` object containing your credentials and an instance of `Becklyn\DiginightsApi\Client` - currently only a curl-based client is provided.
