### Start

* From the root, execute DOCKER
    ```
    \wallbox-php-backend-kata-master> .\init.sh
    ```
* Shows the running containers
    ```
     \wallbox-php-backend-kata-master> docker ps
    ```

```
CONTAINER ID   IMAGE                                    COMMAND                  CREATED          STATUS          PORTS                           NAMES
95ef7aab6d29   wallbox-php-backend-kata-master_apache   "/bin/sh -c 'apachec…"   47 minutes ago   Up 47 minutes   443/tcp, 0.0.0.0:8003->80/tcp   sf4_apache
af9096216b62   wallbox-php-backend-kata-master_php      "docker-php-entrypoi…"   47 minutes ago   Up 47 minutes   9000/tcp                        sf4_php
```
* Open tty
```
\wallbox-php-backend-kata-master> docker exec -it sf4_php  bash
```
* install PHP packages 
```
/home/wwwroot/sf4# composer install
```
* Execute unit test
```
/var/www/sf4# ./vendor/bin/simple-phpunit
```
* Via Console Commands
    * Open a tty: docker exec -it sf4_php  bash
    * Command: php bin/console app:auto-pilot Upper-Right-X[space]Upper-Right-Y[space]Position-X[space]Position-Y[space]Direction[space]Instructions-To-Explore
    * Execute: 
        * command 1: php bin/console app:auto-pilot 5 5 1 2 N LMLMLMLMM
        * command 2: php bin/console app:auto-pilot 5 5 1 2 N LMLMLMLMM 3 3 E MMRMMRMRRM
        * command 3: php bin/console app:auto-pilot 5 5 1 2 N LMLMLMLMM 3 3 E MMRMMRMRRM 3 3 E MMRMMRMRLM

    * By web use http://localhost:8003/auto-pilot

# Backend Challenge

## Learning Competencies
- Challenge understanding.
- Implement Object Oriented Desing, DDD, patterns and best practices.
- Implement tests.
- Manipulate Input/Output correctly.

## The challenge
We've received a user story from product team.
A group of electric vehicles (EV) with autopilot are being landed by Wallbox on a city.
The area of that city, which is curiously rectangular, must be navigated by these EVs so that their on-board webcams and detectors can get a complete view of the surrounding terrain.
A EV's position and location is represented by a combination of x and y coordinates, and a letter representing one of the four cardinal compass points.
**The area is divided up into a grid to simplify the navigation.** An example position might be 0, 0, N, which means the EV is in the bottom left corner and facing North.
All the EVs are positionated in the city area, and to represent that we'll get an input like `0, 0, N`, being the first digit the x axis and the second one y axis and the last letter is the direction where the EV is heading.
Taking into account that the only possible letters are: N, E, S and W.
The EVs can only receive the following instructions: R, L and M (move forward).
'R' and 'L' make the rover spin 90 degrees left or right respectively, without moving from its current spot. 'M' means move forward one grid point, and maintain the same heading.

---

## INPUT:
The first line of input is the upper-right coordinates of the area (akka area limit), the lower-left coordinates are assumed to be 0,0.
The rest of the input is information pertaining to the EVs that have been deployed. Each EV should has two lines of input.
The first line gives the EV's position, and the second line is a series of instructions telling the EV how to explore the area.
The position is made up of two integers, and a letter separated by spaces, corresponding to the x and y co-ordinates and the EV's orientation.
Each EV will be finished sequentially, which means that the second EV won't start to move until the first one has finished moving.
Take into account that only one EV can be in the same position.

## OUTPUT
The output for each EV should be its final co-ordinates and heading.

---

## Input Cheat Sheet
The output for each EV should be its final co-ordinates and heading.

# Test Input:
```
5 5
1 2 N
LMLMLMLMM
3 3 E
MMRMMRMRRM
```

# Expected Output:
```
1 3 N
5 1 E
```
