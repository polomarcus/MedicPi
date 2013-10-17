#include <wiringPi.h>
#include <iostream>
#include <stdio.h>
#include <sys/time.h>
#include <stdlib.h>
#include <sstream>
/*
Par Idleman (idleman@idleman.fr - http://blog.idleman.fr)
Licence : CC by sa
Toutes question sur le blog ou par mail, possibilité de m'envoyer des bières via le blog

Pour recompiler cette source : g++ capteurOuverture.cpp -o capteurOuverture -lwiringPi
Pensez a mettre les permissions :  sudo chmod 777 capteurOuverture
Puis executez : ./capteurOuverture /var/www/capteurOuverture/capteurOuverture.php  0

*/

using namespace std;


int pin = 0;

void log(string a){
        //Décommenter pour avoir les logs
        cout << a << endl;
}


string longToString(long mylong){
    string mystring;
    stringstream mystream;
    mystream << mylong;
    return mystream.str();
}



int main (int argc, char** argv)
{
        //string commandPHP;
        string command;
        string path = "php ";
		path.append(argv[1]);
        log("Demarrage du programme");
        pin = atoi(argv[2]);
        //Si on ne trouve pas la librairie wiringPI, on arrête l'execution
    if(wiringPiSetup() == -1)
    {
        log("Librairie Wiring PI introuvable, veuillez lier cette librairie...");
        return -1;
    }
    pinMode(pin, INPUT);
        log("Pin GPIO configure en entree");

        for(;;)
        {
                if(digitalRead(pin) == 1) {
                        //Gestion de token ? 21/04/2013
                        string commandPHP = "wget -q -O /dev/null ";

                        commandPHP.append(argv[1]); //+Token
                        
                        system(commandPHP.c_str());
                        delay(1000); 
                }
				else {
                        delay(1000);
                }

         }


}
