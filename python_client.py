from zeep import Client

data = {"roomid": 4, 
		"time": "2018-10-24 01:27:00", 
		"temperature":26.55, 
		"humidity":32.44}

wsdl_url = "https://test-soap-peepraeza.c9users.io/server.php?wsdl" 
soap_client = Client(wsdl_url)
test = soap_client.service.insertAirData(**data)

print(test)
