# Wizmo Sandbox Projekt
[logo]: https://www.wizmo.de/media/show/26/logo/0/media_26.png "Wizmo GmbH"

Die ist ein kleines Sandbox-Projekt zum herumspielen mit Testing Frameworks. Neben den Testing Frameworks geht es auch 
um die Codequalität im Projekt und die entwicklungsmethoden TDD und BDD. 

- [1. Automatisiertes Testen](#1.-Automatisiertes-Testen)
    - [UnitTests](#UnitTests)
    - [Feature Tests](#Feature Tests)
    - [Integration Tests](#Integration Tests)
- [2. Testmethoden](#2.-Testmethoden)
    - [Anti-Pattern](#Anti-Pattern)
    - [Test Driven Development (TDD)](#Test-Driven-Development-(TDD))
    - [Behavior Driven Development (BDD)](#Behavior-Driven-Development-(BDD))
- [3. Code Qualität](#3.-Code-Qualität)
- [3. Software Design](#3.-Software-Design)
    - [Design Patterns](#Design-Patterns)
- [4. Setup phpStorm](#4.-Setup-phpStorm)
- [5. Tool Liste](#5.-Tool-Liste)

## 1. Automatisiertes Testen
> Jeder Test ist besser als kein Test!

Wenn man anfängt das Programmieren zu lernen, lernt man viel mit __try and error__. Mit der Zeit wird man aber besser
doch meistens bleibt die Methodik __try and error__ erhalten. Man schreibt Code, geht in den Browser und testet ob das 
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
Ein __Gast__ hat __1 Produkt__ und ein __Gutschein__ im Warenkorb. Die __Rechnungsadresse ist gleich der Lieferadresse__ 
und Versand wird die Bestellung via __DHL__. Bezahlt wird mit __PayPal__.

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
- das Aufsetzen eines Projekts dauert länger

### UnitTests
Ein UnitTest test immer nur eine Unit(Einheit/Module). In PHP würde man für eine Klasse eine TestKlasse erstellen und 
dort für jede __public function__ mindestens eine test Methode implementieren.    
Bei UnitTests ist darauf zu achten, das man auch wirklich nur die Unit testet, dazu muss immer eine feste Umgebung erschaffen
werden. Das heißt Zeit, globale Variablen, die Datenbank usw. müssen bei jedem Testdurchlauf gleich sein. 

UnitTest stellen die kleinste Einheit beim automatisierten Testen dar.

**Best Practice**: 
- man teste immer nur die nach außen sichtbaren methoden (public API)
    __(private Methoden/Funktionen werden eh in public aufgerufen)__
- alle Abhängigkeiten sollten gemockt werden
    __(ermöglicht das Steuern welche Parameter und Return Werte der Mock erhält und liefert)__
- UnitTests müssen in einer isolierten Umgebung laufen und dürfen sich nicht beeinflussen 
    __(für jeden Test muss die Umgebung zurückgesetzt werden)__
- möglichst nur ein assert je test Methode
    __(wenn ein Test fehlschlägt, ist direkt ersichtlich welcher Teil funktioniert und welcher nicht)__
- der Name der Testmethode sollte beschreiben was in dem Test passiert bsp: fooShouldReturnTheStringBarSuccessfully
    __(für den Dokumentationsaspekt)__
- Werte auf die getestet wird dürfen keine zufälligen Werte genommen werden
    __(erhöht die Nachvollziehbarkeit der Tests)__
- eine test sollte nicht länger als eine Sekunde dauern
    __(das Ausführen der Tests sollen die Entwicklung nicht behindern)__

#### Mocking
Bei einem Mock wird eine Abhängigkeit, zum Beispiel eine Klasse ganz oder teilweise durch eine Fake Klasse ersetzt, 
damit man exakt steuern kann, welche Werte die Abhängigkeit erwartet, was sie zurückgibt, wie oft eine Methode aufgerufen wird
oder auch ob der aufruf einer Methode eine Exception schmeißt. Zudem beschleunigt das Mocken die Ausführung der Tests, da 
hier kein weiterer Code ausgeführt wird.

### Feature Tests
Als nächst größere Testeinheit gibt es die Feature testes, dass könnte zum Beispiel das Testen eines API Endpunktes sein. 
Das heißt, hier wird gegen das gesamte System getestet. 

**Best Practice**: 
- man teste immer nur die nach außen sichtbaren methoden (public API)
    __(private Methoden/Funktionen werden eh in public aufgerufen)__
- die Tests müssen in einer isolierten Umgebung laufen und dürfen sich nicht beeinflussen 
    __(für jeden Test muss die Umgebung zurückgesetzt werden)__
- möglichst nur ein assert je test Methode
    __(wenn ein Test fehlschlägt, ist direkt ersichtlich welcher Teil funktioniert und welcher nicht)__
- der Name der Testmethode sollte beschreiben was in dem Test passiert bsp: createUserShouldCreateANewUserInTheDatabaseSuccessfully
    __(für den Dokumentationsaspekt)__
- Werte auf die getestet wird dürfen keine zufälligen Werte genommen werden
    __(erhöht die Nachvollziehbarkeit der Tests)__

### Integration Tests
Integration Tests testen das gesamt system, von der GUI über den PHP Process bis zu Datenbank. Hierfür werden konkrete User
Storys vorgegeben, welche beschreiben was in der GUI geklickt wird und wie die Applikation darauf reagiert.

**Best Practice**: 
- Integration Tests sind im ideal fall konkrete User Storys 
- die Tests müssen in einer isolierten Umgebung laufen und dürfen sich nicht beeinflussen 
    __(für jeden Test muss die Umgebung zurückgesetzt werden)__
- der Name der Testmethode sollte beschreiben was in dem Test passiert bsp: createUserShouldCreateANewUserInTheDatabaseSuccessfully
    __(für den Dokumentationsaspekt)__
- Werte auf die getestet wird dürfen keine zufälligen Werte genommen werden
    __(erhöht die Nachvollziehbarkeit der Tests)__
    
## 2. Testmethoden

### Anti Pattern


> Trotzdem gild, jeder Test ist ein guter Test.

### Test Driven Development (TDD)

Red -> Green -> Refactor

### Behavior Driven Development (BDD)

## 3. Code Qualität

## 3. Software Design

### Design Patterns 

## 4. Setup phpStorm


## 5. Tool Liste
- [PHP](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [PHPMD](https://phpmd.org/) PHP Mess Detector
- [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
- [PHP-FIG](https://www.php-fig.org/)
- [PHPUnit](https://phpunit.de/)
- [behat](https://docs.behat.org/)
