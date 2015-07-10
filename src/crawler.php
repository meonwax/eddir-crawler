<?php
include('../lib/simple_html_dom.php');

define('URL', 'http://www.kita.de/kitas/umkreissuche/a=q&zip=65936&is_hort=1&distance=5&p=');
define('ENTRIES_PER_PAGE', 10);

$page = 0;

do {
	echo "----------------\nPage #" . $page . "\n----------------\n";

	$html = file_get_html(URL . ($page + 1));
	$count = 0;
	foreach($html->find('.kita') as $kita) {
		echo '#' . $count++ . "\n";
		echo 'Name: ' . html_entity_decode($kita->find('h3', 0)->plaintext) . "\n";
		echo 'Address: ' . html_entity_decode(trim(preg_replace('/\s+/', ' ', $kita->find('div.left', 0)->plaintext))) . "\n";
		echo 'Free: ' . $kita->find('div.right div.line div.small div.capacity-bar span', 0)->plaintext . "\n\n";
	}
	$page++;
} while ($count == ENTRIES_PER_PAGE)

// TODO: Fetch details from link

?>
