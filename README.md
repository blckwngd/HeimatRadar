# HeimatRadar: Ein Verwaltungstool für dezentrale Hof- und Gartenmärkte

## Projektbeschreibung

Dieses Tool dient der Verwaltung und Organisation von dezentralen Hof- und Gartenmärkten. Es ermöglicht den Anwohnern und Anwohnerinnen, Stände auf ihren Grundstücken anzumelden, um gebrauchte Waren anzubieten. Die Software unterstützt die Organisatoren bei der Verwaltung der teilnehmenden Haushalte und erstellt eine interaktive Karte, um Besucher*innen eine einfache Orientierung zu ermöglichen.

Durch die teilautomatisierte Verwaltung reduziert das Tool den Arbeitsaufwand für die ehrenamtlichen Organisatorinnen und Organisatoren erheblich.

## STATUS

Die Software befindet sich in der Überarbeitung und Erweiterung. Der aktuelle Stand im Repository ist *nicht* lauffähig.
Bis zur ersten voll lauffähigen Version dient der Code dazu, den Fortschritt des Projekts zu verfolgen und zu dokumentieren.

### Funktionsumfang (in Entwicklung)

- **Teilnehmerregistrierung**: Einfache Registrierung für teilnehmende Haushalte.
- **Interaktive Karte**: Automatische Erstellung einer Karte mit allen teilnehmenden Ständen für Besucher.
- **Automatisierte Benachrichtigungen**: Admins werden automatisch überneue Einträge informiert.
- **Verifikation**: Admins können neue Einträge verifizieren, bevor diese in die Karte aufgenommen werden.
- **Druckansicht**: Überblick über die teilnehmenden Stände mit jeweiligem Angebot.

## Installation

> **Hinweis:** Dieses Tool befindet sich aktuell in der Entwicklung. Die nachfolgenden Schritte zur Installation und Verwendung können sich noch ändern.

1. Repository klonen:
   ```bash
   git clone https://github.com/blckwngd/HeimatRadar.git

2. Anpassen der Texte und Übersetzungen
   Alle Texte sind im Verzeichnis www/i18n/ definiert. Dort können Inhalte und Übersetzungen an die jeweiligen Anforderungen angepasst werden.

3. Anpassen der Konfiguration
   passe die Datenbankverbindung unter www\config\config.php an

4. Erstellen der MySQL-Tabelle
   Rufe das MySQL-Verwaltungswerkzeug deiner Wahl auf (z.B. phpMyAdmin) und importiere die Datei sql\schema.sql
   Das erstellt eine neue Tabelle "heimatradar" in der gewählten Datenbank.


## Mitwirken
Beiträge und Verbesserungsvorschläge sind willkommen! Bitte erstelle einen Issue oder einen Pull-Request, falls du Ideen oder Bugfixes hast.

## Lizenz
Dieses Projekt steht unter der MIT-Lizenz. Weitere Informationen findest du in der Datei LICENSE.
