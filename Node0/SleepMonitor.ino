//Uses available sensors to guess whether you are asleep

boolean checkSleep() {
  const int threshold0 = 550;
  const int threshold1 = 550;
  const int threshold2 = 50;
  int sensorValue0 = analogRead(FORCE0);        // value read from the sensors
  int sensorValue1 = analogRead(FORCE1);        
  int sensorValue2 = analogRead(FORCE2);        
  if ((sensorValue0 > threshold0) || (sensorValue1 > threshold0) || (sensorValue2 > threshold2)) {
    return true;
  } else {
    return false;
  }
}
