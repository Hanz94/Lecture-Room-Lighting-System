#include <UIPEthernet.h>


byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED }; //physical mac address
byte ip[] = { 192, 168, 1, 100 }; // ip in lan
byte gateway[] = { 192, 168, 1, 1 }; // internet access via router
byte subnet[] = { 255, 255, 255, 0 }; //subnet mask
EthernetServer server(80); //server port

EthernetClient client;
IPAddress server2(192,168,1,178 );
String readString;
int  interval = 500; // Wait between dumps
int swt;
int sensorReading;//analog pin reading
int brightness;


void setup(){
  pinMode(8, OUTPUT); //pin selected to control
  pinMode(13,OUTPUT);
  //start Ethernet
  Ethernet.begin(mac, ip, gateway, gateway, subnet);
  digitalWrite(13,HIGH);
  server.begin(); 
  Serial.begin(9600);
  Serial.println("Arduino Server IP is -: ");
   Serial.print(Ethernet.localIP()); 
  
cli();//stop interrupts

//set timer1 interrupt at 1Hz
  TCCR1A = 0;// set entire TCCR1A register to 0
  TCCR1B = 0;// same for TCCR1B
  TCNT1  = 0;//initialize counter value to 0
  // set compare match register for 1hz increments
  OCR1A = 15624;// = (16*10^6) / (1*1024) - 1 (must be <65536)
  // turn on CTC mode
  TCCR1B |= (1 << WGM12);
  // Set CS12 and CS10 bits for 1024 prescaler
  TCCR1B |= (1 << CS12) | (1 << CS10);  
  // enable timer compare interrupt
  TIMSK1 |= (1 << OCIE1A);


sei();//allow interrupts

}//end setup


ISR(TIMER1_COMPA_vect){//timer1 interrupt 1Hz toggles pin 13 (LED)
EthernetClient client2 = server.available();
  if (client2) {
    while (client2.connected()) {
      if (client2.available()) {
        char c = client2.read();

        //read char by char HTTP request
        if (readString.length() < 100) {
          //store characters to string 
          readString += c; 
        } 

        //if HTTP request has ended
        if (c == '\n') {

          ///////////////
          Serial.println(readString); //print to serial monitor for debuging 

          client2.println("HTTP/1.1 200 OK"); //send new page
          client2.println("Content-Type: text/html");
          client2.println();
          client2.println("<HTML>");
          client2.println("<script type='text/javascript'>");
	  client2.println ("window.location.replace('http://localhost/Demo2/connectarduino.php');");
	  client2.println ("</script>");
          client2.println("</HTML>");
      
          delay(2);
          //stopping client
          client2.stop();

          ///////////////////// Get Data From The webServer
          
          
          if(readString.indexOf("on") >0)//checks for on
          {
            swt = 1;
            Serial.println("Led On");
            analogWrite(8,brightness);
            
          }
          if(readString.indexOf("off") >0)//checks for off
          {
            swt = 0;
            Serial.println("Led Off");
            digitalWrite(8,LOW);
          }
          //clearing string for next read
          readString="";

        }
      }
    }
  }
  
}

void loop()
{
  if(swt == 1){
    sensorReading=analogRead(2);  //get analog reading
    brightness = map(sensorReading,200,1023,255,0);
    analogWrite(8,brightness);
    if (client.connect(server2, 80)) {
      Serial.println("-> Connected");
      // Make a HTTP request:
      client.print( "GET /Demo2/pushdata.php?");
      client.print("intensity=");
      client.print( brightness );
      client.println( " HTTP/1.1");
      client.print( "Host: " );
      client.println(server2);
      client.println( "Connection: close" );
      client.println();
      client.println();
      client.stop();
      Serial.print("Data sent");
    }
    else {
      // you didn't get a connection to the server:
      Serial.println("--> connection failed/n");
    }
  }

  
//    if(swt == 1){
//      sensorReading=analogRead(0);  //get analog reading
//      brightness = map(sensorReading,400,1023,255,0);
//      analogWrite(12,brightness);
//  }
  else{
    digitalWrite(8,LOW);
  }
  
  delay(interval);
  
}
