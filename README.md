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
Min applikation kör via https för att informationen som skickas mellan klient och server ska vara krypterad. 
Jag har även skyddat mig mot CSRF attacker med hjälp av token i ett gömt inputfält i mitt formulär. För att försöka förhindra XSS attacker har jag använt mig av strip_tags() i php för att ta bort eventuella tags i koden.

Då jag inte hanterar någon känslig data eller skriver ut något som postas av användaren, så hade jag egentligen inte behövt all denna säkerhet just nu. Men genom att applikationen i framtiden kan tänkas att byggas ut i funktionalitet med bland annat inloggning ville jag använda mig av detta ändå. 

##Prestandaoptimering

Jag har minifierat alla mina css och javascriptfiler som jag använder mig av i koden. 
Jag har även länkat in css filerna i headern samt javascriptfilerna längst ner i bodyn för att få en så snabb inläsning av sidan som möjligt. 
Med undantag av offline.js samt ett tillhörande script som kollar uppkoppling statusen, som fick placeras i headern för att uppnå bra funktionalitet. Jag har även använt mig av cdn, både till bootstrap och jquery.  

En av den större boven i min optimering känner jag är Omdbs api då jag tvingas att göra en mängd olika förfrågningar för att få ut den informationen jag behöver. 
Det hade varit underbart om all information kunde skickas med när förfrågning görs mot apiet med söknamnet istället för att man måste skicka en förfrågning per ImdbID för att bland annat få tillgång till handlingen till den sökta filmen/tv-serien. 

##Offline-first
Jag har valt att använda mig av biblioteket offline.js för att visa tydligt för användaren när internet uppkopplingen förloras/återupptas. Detta bibliotek var väldigt smidigt att använda och använder sig av ajax anrop för att hålla koll på sidans uppkoppling.

Jag lade även till funktionalitet så att uppkopplingens status kollas var tredje sekund detta för att kunna inaktivera sökfunktion och knappar i applikationen om uppkopplingen skulle tappas.

##Risker med applikationen

##Reflektion kring projektet
