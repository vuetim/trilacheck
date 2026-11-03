<?php
/** Topic-specific guidance for existing mobile comparison pages. @package Trilacheck */
defined( 'ABSPATH' ) || exit;

return array(
	'handytarife-5gb' => array(
		'usage' => 'Schau in den Einstellungen deines Smartphones nach dem mobilen Verbrauch mehrerer Monate. Downloads im WLAN können helfen, mit 5 GB auszukommen; automatisch abgespielte Videos und Cloud-Backups unterwegs verbrauchen dagegen zusätzliches Volumen.',
		'criteria' => array(
			'Daten nach Verbrauch' => 'Prüfe, ob nach 5 GB gedrosselt wird oder kostenpflichtig Daten nachgebucht werden. Achte besonders auf eine mögliche Datenautomatik.',
			'Kleines Paket, faire Gesamtkosten' => 'Rechne Anschlussgebühren und das Ende von Rabatten mit ein. Ein niedriger Monatsbetrag allein zeigt noch nicht die Kosten über die gesamte Mindestlaufzeit.',
			'WLAN im Alltag' => 'Überlege, wie oft du zu Hause, im Büro oder an der Hochschule WLAN nutzt. Entscheidend sind die Tage, an denen du tatsächlich mobile Daten brauchst.',
			'Reserve für Ausnahmen' => 'Wenn du regelmäßig an die Grenze kommst, vergleiche ein größeres Paket. Einzelne Nachbuchungen können die Ersparnis eines kleinen Tarifs aufbrauchen.',
		),
		'question' => 'Reichen 5 GB auch für Videos?',
		'answer' => 'Das hängt von Auflösung und Wiedergabedauer ab. Regelmäßiges mobiles Videostreaming kann ein kleines Datenpaket schnell aufbrauchen. Lade Inhalte möglichst im WLAN herunter und kontrolliere deinen tatsächlichen Verbrauch.',
	),
	'handytarife-15gb' => array(
		'usage' => 'Ein 15-GB-Paket lässt sich am besten anhand deines normalen Monatsverbrauchs beurteilen. Berücksichtige auch Pendeltage, Social-Media-Videos und Musik unterwegs, statt nur einen einzelnen sparsamen Monat als Maßstab zu nehmen.',
		'criteria' => array(
			'Alltag und Verbrauchsspitzen' => 'Vergleiche den Durchschnitt mit deinem höchsten Monatsverbrauch. Ein kleiner Puffer kann sinnvoll sein, wenn sich Arbeit, Ausbildung oder Freizeit häufig außerhalb des WLANs abspielen.',
			'Preis über die Vertragszeit' => 'Prüfe den Grundpreis nach der Rabattphase und mögliche einmalige Kosten. Vergleiche Angebote über denselben Zeitraum.',
			'Empfang auf dem Arbeitsweg' => 'Schau auf die Versorgung entlang deiner üblichen Strecken. Mehr Datenvolumen hilft wenig, wenn der Empfang an deinen wichtigsten Orten nicht passt.',
			'Flexibel aufstocken' => 'Lies nach, ob und zu welchen Bedingungen sich das Datenpaket später ändern lässt. Verlasse dich nicht darauf, dass eine größere Option kostenlos verfügbar ist.',
		),
		'question' => 'Wann lohnt sich der Schritt von 5 auf 15 GB?',
		'answer' => 'Wenn du mit einem kleinen Paket regelmäßig nachbuchen musst oder deine Nutzung zunimmt, lohnt sich ein Vergleich. Stelle den Mehrpreis den bisherigen Nachbuchungskosten gegenüber und prüfe zugleich Laufzeit und Netz.',
	),
	'handytarife-50gb' => array(
		'usage' => 'Bei 50 GB stehen häufig Videotelefonie, Streaming und die Verbindung eines Laptops im Vordergrund. Prüfe deshalb nicht nur die Datenmenge, sondern auch, ob Geschwindigkeit und Empfang für diese Anwendungen ausreichen.',
		'criteria' => array(
			'Hotspot mit Laptop' => 'Updates, Videokonferenzen und Datei-Synchronisierung können am Laptop mehr Daten übertragen als erwartet. Kontrolliere den Verbrauch aller verbundenen Geräte.',
			'Datenrate und 5G' => 'Ein großes Datenpaket sagt nichts über die maximale Übertragungsrate aus. Lies die angebotene Geschwindigkeit und die Voraussetzungen für 5G im Tarif nach.',
			'50 GB oder Unlimited' => 'Vergleiche den Aufpreis zu unbegrenzten Angeboten mit deinem tatsächlichen Bedarf. Wer deutlich unter 50 GB bleibt, braucht allein wegen der Paketgröße keinen Unlimited-Tarif.',
			'Nutzung auf Reisen' => 'Prüfe die Roamingbedingungen und das im Reiseland nutzbare Datenvolumen. Gehe nicht davon aus, dass sämtliche Inlandsleistungen überall gelten.',
		),
		'question' => 'Ersetzen 50 GB einen Internetanschluss zu Hause?',
		'answer' => 'Für eine zeitweise Verbindung kann das Paket ausreichen. Mehrere Geräte, große Downloads und regelmäßige Videos können es jedoch stark belasten. Prüfe deinen Haushaltsverbrauch, die Vertragsbedingungen und den Empfang am Nutzungsort.',
	),
	'handytarife-unlimited' => array(
		'usage' => 'Unbegrenztes Datenvolumen und unbegrenzte Geschwindigkeit sind zwei unterschiedliche Eigenschaften. Vergleiche deshalb die konkrete Leistungsbeschreibung, bevor du den Tarif für Streaming, Arbeit oder einen dauerhaften Hotspot auswählst.',
		'criteria' => array(
			'Dauerhafte Geschwindigkeit' => 'Achte auf die maximale Datenrate und mögliche Einschränkungen. Der Begriff Unlimited allein beschreibt weder die Geschwindigkeit noch den Empfang.',
			'Nachbuchung erforderlich?' => 'Lies nach, ob das Volumen ohne weiteres Zutun unbegrenzt verfügbar ist oder zusätzliche Datenpakete aktiv freigeschaltet werden müssen.',
			'Roaming separat prüfen' => 'Im Ausland können andere Datenlimits und Bedingungen gelten als im Inland. Prüfe die Angaben für dein Reiseziel im jeweiligen Angebot.',
			'Router und Hotspot' => 'Wenn du einen Router oder mehrere Geräte verwenden möchtest, prüfe die zulässige Nutzung sowie die Netzversorgung am geplanten Standort.',
		),
		'question' => 'Ist ein Unlimited-Tarif automatisch schneller?',
		'answer' => 'Nein. Unlimited bezeichnet das Datenvolumen. Die erreichbare Geschwindigkeit hängt unter anderem von der vereinbarten Datenrate, dem Netz, dem Endgerät und der Auslastung vor Ort ab.',
	),
	'tarife-fur-junge-leute' => array(
		'usage' => 'Vergleiche bei einem Young-Angebot nicht nur den beworbenen Vorteil, sondern auch die Voraussetzungen. Altersgrenzen, erforderliche Nachweise und die Dauer einer Vergünstigung können sich je nach Anbieter unterscheiden.',
		'criteria' => array(
			'Berechtigung nachweisen' => 'Lies vor der Bestellung, welche Altersgruppe angesprochen wird und ob weitere Nachweise verlangt werden. Ein Young-Tarif ist nicht automatisch für jede Person in Ausbildung verfügbar.',
			'Ende des Vorteils' => 'Prüfe, wie lange Rabatt oder zusätzliches Datenvolumen gelten und was bei Erreichen der Altersgrenze passiert.',
			'Alltag zwischen Uni und Arbeit' => 'Wähle Datenvolumen und Netz nach deinem tatsächlichen Tagesablauf. WLAN auf dem Campus ersetzt keinen passenden Empfang auf dem Weg dorthin.',
			'Handy oder reine SIM' => 'Vergleiche bei einem Angebot mit Smartphone die gesamten Gerätekosten mit einem separaten Kauf und einem SIM-only-Tarif.',
		),
		'question' => 'Brauche ich für einen Young-Tarif einen Studierendenausweis?',
		'answer' => 'Das ist vom Angebot abhängig. Manche Vergünstigungen orientieren sich am Alter, andere verlangen zusätzliche Nachweise. Maßgeblich sind die Voraussetzungen des jeweiligen Anbieters.',
	),
	'prepaid-tarife' => array(
		'usage' => 'Bei Prepaid entscheidest du über Guthaben und gebuchte Optionen. Für einen sinnvollen Preisvergleich sind das Abrechnungsintervall und die Verlängerungsbedingungen genauso wichtig wie die angegebene Datenmenge.',
		'criteria' => array(
			'Vier Wochen oder ein Monat' => 'Unterscheide einen Vier-Wochen-Zeitraum von einem Kalendermonat. Vergleiche die Kosten über einen vollständigen Jahreszeitraum, statt beide Beträge gleichzusetzen.',
			'Option verlängern' => 'Prüfe, ob sich ein Paket bei ausreichendem Guthaben automatisch erneuert und welche Leistungen gelten, wenn das Guthaben nicht reicht.',
			'Automatische Aufladung' => 'Lies nach, wann eine Aufladung ausgelöst wird und welche Betragsgrenzen sich einstellen lassen. So behältst du auch bei hinterlegter Zahlungsmethode den Überblick.',
			'Selten genutzte SIM' => 'Wenn du die Karte nur gelegentlich brauchst, prüfe die Bedingungen für längere Inaktivität und mögliche Anforderungen an regelmäßige Aufladungen.',
		),
		'question' => 'Kann Prepaid ohne laufendes Datenpaket genutzt werden?',
		'answer' => 'Das hängt vom gewählten Basistarif ab. Prüfe Einzelpreise für Telefonie, SMS und Daten sowie die Bedingungen zum Abbestellen von Optionen. Ein verbrauchter Datenpass bedeutet nicht bei jedem Angebot dasselbe.',
	),
);
