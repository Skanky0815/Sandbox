# Wizmo Sandbox Projekt
[logo]: https://www.wizmo.de/media/show/26/logo/0/media_26.png "Wizmo GmbH"

[![pipeline status](https://gitlab.dc2.wizmo.cloud/rschulz/sandbox/badges/master/pipeline.svg)](https://gitlab.dc2.wizmo.cloud/rschulz/sandbox/-/commits/master)
[![coverage report](https://gitlab.dc2.wizmo.cloud/rschulz/sandbox/badges/master/coverage.svg)](https://gitlab.dc2.wizmo.cloud/rschulz/sandbox/-/commits/master)

Die ist ein kleines Sandbox-Projekt zum herumspielen mit Testing Frameworks. Neben den Testing Frameworks geht es auch 
um die Codequalität im Projekt und die Entwicklungsmethoden TDD und BDD. 

[[_TOC_]]

## 1. Automatisiertes Testen
Wenn man anfängt das Programmieren zu lernen, lernt man viel mit _try and error_. Mit der Zeit wird man aber besser
doch meistens bleibt die Methodik _try and error_ erhalten. Man schreibt Code, geht in den Browser und testet ob das 
implementierte funktioniert. Am Anfang geht es noch recht schnell, wird die Applikation aber größer, dann nimmt auch die
Zeit, welche man zum manuellen Testen braucht immer mehr zu.

----
Nehmen wir zum Beispiel ein Checkout, welchen wir testen wollen. Für einen standard Checkout (wie ihn Shopware hat) gibt es 
folgende TestCases:

|1. Account| 2. Warenkorb | 3. Adressen | 4. Versand | 5. Bezahlart|
|----------|--------------|-------------|------------|-------------|
| Gast      |1 Produkt | Rechnung === Lifer | DHL | PayPal |
| Registriert | Gutschein | Rechnung !== Lifer | Hermes |Visa|
| Bestehender | 1 Varianten Artikel | - | UPS | AmazonPay |
| - | ... | - | ... | ... | 
 
Was wäre ein konkreter TestCase?
Ein _Gast_ hat _1 Produkt_ und ein _Gutschein_ im Warenkorb. Die _Rechnungsadresse ist gleich der Lieferadresse_
und Versand wird die Bestellung via _DHL_. Bezahlt wird mit _PayPal_.

Jetzt kann man überlegen, wie viele TestCases ein Checkout hat und wie lange es dauert, bis man alle Varianten durchgetestet
hat (eventuell zurücksetzten der Datenbank, Produkte auswählen, usw). 

----

**Die Lösung für das Problem sind automatisierte Test.** 

Automatisierte Tests werden einmal implementiert / konfiguriert und können immer wieder ausgeführt werden.

**Pros:**
- Tests können dokumentieren wie die Applikation oder eine Klasse funktioniert
- Tests geben das Gefühl eine Bug freie Applikation implementiert zu haben
- man kann den Code refaktorieren oder erweitern ohne das etwas kaputtgeht
- sobald man Tests hat, spart man Zeit bei jeder weiteren Testsitzung
- Code der Testbar ist, ist automatisch sauberer und besser lesbar und weist eine geringere Komplexität auf

**Cons:**
- man Programmiert auch Code welcher nicht produktiv ist
- erfordert einiges an Disziplin
- das Aufsetzen eines Projekts dauert etwas länger

### UnitTests
Ein UnitTest test immer nur eine Unit(Einheit/Module). In PHP würde man für eine Klasse eine TestKlasse erstellen und 
dort für jede _public function_ mindestens eine test Methode implementieren.    
Bei UnitTests ist darauf zu achten, das man auch wirklich nur die Unit testet, dazu muss immer eine feste Umgebung erschaffen
werden. Das heißt Zeit, globale Variablen, die Datenbank usw. müssen bei jedem Testdurchlauf gleich sein. 

UnitTest stellen die kleinste Einheit beim automatisierten Testen dar.

**Framework**:
- PHP: [PHPUnit](https://phpunit.de/), [behat](https://docs.behat.org/), [phpspec](http://www.phpspec.net/)
- JS: [jasmin](https://jasmine.github.io/), [JEST](https://jestjs.io/)
- python: [unittest](https://docs.python.org/3/library/unittest.html#module-unittest)
- Java: [JUnit](https://junit.org)

**Best Practice**: 
- man teste immer nur die nach außen sichtbaren Methoden (public API)
    _(private Methoden/Funktionen werden eh in public aufgerufen)_
- alle Abhängigkeiten sollten gemockt werden
    _(ermöglicht das Steuern welche Parameter und Return Werte der Mock erhält und liefert)_
- UnitTests müssen in einer isolierten Umgebung laufen und dürfen sich nicht beeinflussen 
    _(für jeden Test muss die Umgebung zurückgesetzt werden)_
- möglichst nur ein assert je test Methode
    _(wenn ein Test fehlschlägt, ist direkt ersichtlich welcher Teil funktioniert und welcher nicht)_
- der Name der Testmethode sollte beschreiben was in dem Test passiert bsp: foo_ShouldReturnTheStringBar_Successfully
    _(für den Dokumentationsaspekt)_
- für Werte auf die getestet wird dürfen keine zufälligen Werte genommen werden
    _(erhöht die Nachvollziehbarkeit der Tests)_
- eine test sollte nicht länger als eine Sekunde dauern
    _(das Ausführen der Tests sollen die Entwicklung nicht behindern)_
- es soll nur die eigene Logik getestet werden
    _(also nicht die von Frameworks, der Programmiersprache)_

#### Mocking
Bei einem Mock wird eine Abhängigkeit, zum Beispiel eine Klasse ganz oder teilweise durch eine Fake Klasse ersetzt, 
damit man exakt steuern kann, welche Werte die Abhängigkeit erwartet, was sie zurückgibt, wie oft eine Methode aufgerufen wird
oder auch ob der aufruf einer Methode eine Exception schmeißt. Zudem beschleunigt das Mocken die Ausführung der Tests, da 
hier kein weiterer Code ausgeführt wird.

### Feature Tests
Als nächst größere Testeinheit gibt es die Feature testes, dass könnte zum Beispiel das Testen eines API Endpunktes sein. 
Das heißt, hier wird gegen das gesamte System getestet. 

Die gängigen Frameworks und Projekte haben eigene implementierung für Feature Test, mit der man zum Beispiel das Aufrufen eines
REST-Endpunktes testen kann. In PHP Projekten basieren die Tests auf PHPUnit.

**Best Practice**: 
- man teste immer nur die nach außen sichtbaren methoden (public API)
    _(private Methoden/Funktionen werden eh in public aufgerufen)_
- die Tests müssen in einer isolierten Umgebung laufen und dürfen sich nicht beeinflussen 
    _(für jeden Test muss die Umgebung zurückgesetzt werden)_
- möglichst nur ein assert je test Methode
    _(wenn ein Test fehlschlägt, ist direkt ersichtlich welcher Teil funktioniert und welcher nicht)_
- der Name der Testmethode sollte beschreiben was in dem Test passiert bsp: createUserShouldCreateANewUserInTheDatabaseSuccessfully
    _(für den Dokumentationsaspekt)_
- für Werte auf die getestet wird dürfen keine zufälligen Werte genommen werden
    _(erhöht die Nachvollziehbarkeit der Tests)_

### Integration Tests
Integration Tests testen das gesamte System, von der GUI über den PHP Process bis zur Datenbank. Hierfür werden konkrete User
Storys vorgegeben, welche beschreiben was in der GUI geklickt wird und wie die Applikation darauf reagiert.

Das führt dazu, dass man für die tests auch einen Server braucht, auf dem die zu testende Applikation lauf. Auch ist die
Laufzeit eines Integration Tests sehr hoch, da eventuell Fixture eingespielt werden müssen.  

**Framework**:
- [Selenium](https://www.selenium.dev/)
- [cypress.id](https://www.cypress.io/)

**Best Practice**: 
- Integration Tests sind im Idealfall konkrete User Storys 
- die Tests müssen in einer isolierten Umgebung laufen und dürfen sich nicht beeinflussen 
    _(für jeden Test muss die Umgebung zurückgesetzt werden)_
- der Name der Testmethode sollte beschreiben was in dem Test passiert bsp: createUserShouldCreateANewUserInTheDatabaseSuccessfully
    _(für den Dokumentationsaspekt)_
- Werte auf die getestet wird dürfen keine zufälligen Werte genommen werden
    _(erhöht die Nachvollziehbarkeit der Tests)_
    
## 2. Testmethoden

### Test Driven Development (TDD)
Bei der Test getrieben Entwicklung schreibt man konsequent immer erst ein Test welcher [- fehlschlägt -], implementiert
dann den Produktivcode welche dafür sorgt das der Test [+ erfolgreich durchläuft +] und refaktoriert den geschriebenen Code. 
Anschließend wird die ganze Prozedur wiederholt, bis die gewünschte Funktionalität hergestellt ist.   

[- Red -] -> [+ Green +] -> Refactor
 
 **Pros**:
 - man hat automatisch ein Code coverage von 100 %
 - man schreibt nur Code welcher auch genutzt wird
 - für jede Klasse gibt es ein test
 - man schreibt sauberen Code
 - man hat immer funktionierenden Code
 - wenn man bei der Arbeit unterbrochen wird, weiß man wo man wieder einsteigen kann, denn man hat ein Teste der fehlschlägt 

### Behavior Driven Development (BDD)
Behavior Driven Development basiert grundsätzlich auf den Prinzipien vom TDD, setzt nur globaler an und ist User Story basiert.
Die User Stories werden für jedes Feature definiert, hier für wird die Ausgangslage beschrieben und dann die Interaktionen auf der Webseite.   

Das kann wie folgt aussehen:
``` 
Feature: Sandbox App who says Hello World
  If i brows the site
  As a casual user
  I will greeted from the site after i say my name

  Scenario: I say my name on the site, it greets me with Hello Rico
    Given I am on the homepage
    When I fill in "Name" with "Rico"
      And I press "Senden"
    Then I should see "Hello Rico"
```

Nachdem die User Story definiert wurde, fängt der Entwickler an den Test zu implementieren und wenn der Test fertig ist,
wird die benötigte Funktion implementiert.

**Pros**:
- die Beschreibung des Features kann auf grund der einfachheit vom Projekt Owner oder von einem PM im Meeting mit dem Kunden erstellt werden
- die User Stories können als automatisierte Test ausgeführt werden und dienen auch der Dokumentation
- man kann zu jedem Zeitpunkt sagen, wie viel Prozent der Anforderungen umgesetzt wurden

## 3. Codequalität
Um eine gute Codequalität zu erhalten, sollte man sich an folgende Punkte halten:
**Allgemein**:
- man sollte sich gut in die Software/Framework Dokumentation einlesen, um diese Optimal zu nutzen
- man sollte sich an Coding Style Standards halten wie die PSR Definitionen von [PHP-FIG](https://www.php-fig.org/) in PHP
- der new Operator sollte weitestgehend vermieden werden, da dies das Mocken in Tests erschwert
- man sollte **kein** Code schreiben, welcher eventuell irgendwann einmal genutzt wird
- es dürfen keine unbenutzten Variablen deklariert sein
- es darf kein echo, print_r oder var_dump im Code existieren
- man sollte doppelten Code vermeiden

**Klassen**:
- jede Klasse hat nur eine Aufgabe
- Klassen sollten so wenig wie möglich Abhängigkeiten zu anderen Klassen haben aber maximal 10
- Klassen sollten möglichst wenig öffentliche Methoden oder Parameter haben
- Klassen sollten nicht mehr als 1000 Zeilen lang sein

**Methoden/Funktionen**:
- jede Methode hat nur eine Aufgabe
- Methoden sollte nicht mehr als 100 Zeilen lang sein
- eine Methode sollte möglich wenig Parameter in der Signatur erwarten
- eine Methode hat nur ein Rückgabe Type oder null  
- die Codekomplexität einer Methode sollte klein gehalten werden 

In PHP helfen die tools [PHPMD](https://phpmd.org/) und [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
sich dan die gängigen Standards zu halten. Für Javascript gibt es [standardjs](https://standardjs.com/).

## 4. Software Design

### Design Patterns 

## 5. Setup phpStorm

## 6. Tool Liste
- [PHP](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [PHPMD](https://phpmd.org/) PHP Mess Detector
- [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
- [PHP-FIG](https://www.php-fig.org/)
- [PHPUnit](https://phpunit.de/)
- [behat](https://docs.behat.org/)
- [Selenium](https://www.selenium.dev/) ``` $ brew install geckodriver ``` rund selenium ``` $ java -jar selenium-server-standalone-3.141.59.jar ```
