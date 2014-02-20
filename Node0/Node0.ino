#include <SPI.h>
#include <Ethernet.h>

const char ID[] = "8414"; //Unique ID for this node
const char server[] = "134.173.56.165"; //Name of server to connect to

const int FORCE0 = A0; //First force sensor
const int FORCE1 = A1; //Second force sensor
const int FORCE2 = A2; //Third force sensor

