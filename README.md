# Jingle
Jingle is a lightweight sensory system designed to be deployed on embedded systems.

## Table of Contents
* [Features](#Features)
* [Installation](#Installation (Linux-based systems))
* [Compatible Hardware](#Compatible Hardware)
* [Modules](Modules)

##Features
* A lightweight web interface designed to run on an embedded system
* A robust HTTP communication method allowing easy connection of additional nodes 

## Installation (Linux-based systems)
1. Install an Apache web server on your device
2. Download the web server code into /var/www
3. Update peripheral nodes with IP address of web server

##Compatible Hardware
Jingle is designed to be as hardware independent as possible. The only requirement needed for a node is the ability to connect to the internet. The web server code is written in PHP, so any device running an operating system will suffice. The server may be impacted by the amount of data being collected by peripheral nodes and these considerations should be considered before selecting a server. 

The peripheral node code is written in Arduino and should be compatible with most Arduino devices. In principle, the code could be adapted to other systems, so long as they can send and receive HTTP requests. 

##Modules
###Sleep Monitoring
The sleep monitoring module is designed to passively record your sleep schedule. The provided code is intended to be used with three force sensors. The force sensors are placed discreetly on your bed. When pressure is applied to the sensor, it becomes less resistive. The sensor can be connected in a voltage division system with pressure detected using analog input pins. 
