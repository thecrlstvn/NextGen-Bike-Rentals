#include <WiFi.h>
#include <HTTPClient.h>
#include <TinyGPS++.h>

// Replace with your network credentials
const char* ssid = "iPhone";
const char* password = "Mat08Mat081104";

// GPS object
TinyGPSPlus gps;
HardwareSerial mySerial(1);

// PHP API URL
 
void setup() {
  Serial.begin(115200);
  mySerial.begin(9600, SERIAL_8N1, 16, 17);  // GPS module connections
  
  // Connect to Wi-Fi
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");
}

void loop() {
  while (mySerial.available() > 0) {
    gps.encode(mySerial.read());
    if (gps.location.isUpdated()) {
      // Get the GPS coordinates
      float latitude = gps.location.lat();
      float longitude = gps.location.lng();
      sendDataToServer(latitude, longitude);
    }
  }
}

void sendDataToServer(float latitude, float longitude) {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(serverUrl);

    // Prepare POST data
    String postData = "latitude=" + String(latitude, 6) + "&longitude=" + String(longitude, 6);

    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    int httpResponseCode = http.POST(postData);

    if (httpResponseCode == 200) {
      Serial.println("Data sent successfully");
    } else {
      Serial.print("Error sending data: ");
      Serial.println(httpResponseCode);
    }

    http.end();
  } else {
    Serial.println("WiFi not connected");
  }
}
