from zeep import Client

wsdl_url = "http://test-soap-peepraeza.c9users.io/server_test.php?wsdl" 
soap_client = Client(wsdl_url)

test = soap_client.service.get_std_data("dump")
print(test)
