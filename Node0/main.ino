// Initialize the Ethernet client library
// with the IP address and port of the server 
// that you want to connect to (port 80 is default for HTTP):
EthernetClient client;

Timer sleepTimer;  

void setup() {
  //Set the update interval
  sleepTimer.set_max_delay(600000); // 10 minutes
 // Open serial communications and wait for port to open:
  Serial.begin(9600);

  // start the Ethernet connection:
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to configure Ethernet using DHCP");
    // no point in carrying on, so do nothing forevermore:
    // try to congifure using IP address instead of DHCP:
    Ethernet.begin(mac, ip);
  }
  // give the Ethernet shield a second to initialize:
  delay(1000);
}

void loop()
{ 
  if (sleepTimer.check()) {
    String params = "id=";
    params += ID;
    params += "&query=time";
    params += "&sleep=";
    params += String(checkSleep());
    communicate(client, params);
    Serial.println(params);
  }
  delay(500);
  while(client.available()) {
    char c = client.read();
    Serial.print(c);
  }
  
  client.stop();
}
