#Rapport

###Länk till applikationen
[https://www.anniesahlberg.se/1DV449-Project/](https://www.anniesahlberg.se/1DV449-Project/)

###Presentationsfilm
[https://www.youtube.com/watch?v=lJMhdt-r7Jk](https://www.youtube.com/watch?v=lJMhdt-r7Jk)

##Inledning
Jag har gjort en applikation som gör det möjligt att söka efter filmer/tv-serier och spara dessa i en lista, så man kan hålla reda på det som intresserar en.
Applikationen visar även information om när nästa avsnitt finns tillgängligt i en serie som du sökt på.

I dagsläget använder jag mig av en app på min mobil som heter TVShow Time denna app gör det möjligt för mig att hålla reda på mina tv-serier och vilka avsnitt som kommer, samt vilka jag redan sett. Det denna app saknar är möjligheten att även kolla upp och lägga till filmer, därav  min idé att skapa en applikation som gör detta möjligt. 
Det verkar även som om Imdb har en applikation som kallas Watchlist som likt min håller reda på dina filmer/tv-serier.

På server sidan har jag använt mig av php och på klientsidan javascript (jquery). 
Jag har dessutom använt mig av biblioteket offline.js för offline hantering samt bootstrap ramverk för att underlätta designen. 

För att få fram information över filmer och tv-serier har jag använt mig av Omdb api (http://www.omdbapi.com/), och information om nästkommande avsnitt har jag hämtat ifrån epguides api (https://epguides-api.readthedocs.org/en/latest/). 
##Schematisk bild
![Schematisk bild](https://github.com/as223my/1DV449-Projekt-as223my/blob/master/SchematiskBild.png)

##Säkerhet
Min applikation kör via https för att informationen som skickas mellan klient och server ska vara krypterad. Jag har även skyddat mig mot CSRF attacker med hjälp av token i ett gömt inputfält i mitt formulär. Jag har även försökt att skydda min applikation mot XSS attacker då jag använder mig av strip_tags() i php för att ta bort eventuella tags.

Då jag inte hanterar någon känslig data eller skriver ut något som postas av användaren, så hade jag egentligen inte behövt all denna säkerhet just nu. Men genom att applikationen i framtiden kan tänkas att byggas ut i funktionalitet med bla inloggning ville jag använda mig av detta ändå. 

##Prestandaoptimering

##Offline-first

##Risker med applikationen

##Reflektion kring projektet
