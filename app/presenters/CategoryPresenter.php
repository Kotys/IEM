<?php

namespace App\Presenters;

use Nette\Application\UI\Presenter;
use Nette\Utils\Strings;

/**
 * @author Jan Kotrba <kotrba@kotyslab.cz>
 */
class CategoryPresenter extends Presenter
{
	public function actionDefault($category, $procedure = null)
	{
		if (!$category) {
			$this->redirect('Category:default', [
				'esteticka-medicina'
			]);
		}

		$this->getTemplate()->category = $category;
		$this->getTemplate()->procedure = $procedure ? $procedure : false;
		$this->getTemplate()->nav = $this->getCategoryNavigation($category);
		$title = $category == 'esteticka-medicina' ? 'Estetická medicína' : 'Kosmetika';

		if ($procedure) {
			$title = $this->getCategoryNavigation($category)[$procedure];
			$this->getTemplate()->articleTitle = $title;
			$this->getTemplate()->article = $this->getArticleForProcedure($procedure);
		}

		$this->getTemplate()->title = $title;
	}

	private function getCategoryNavigation($category)
	{
		$procedures = [];

		switch ($category) {
			case 'esteticka-medicina':
				$procedures[] = "Plazmaterapie";
				$procedures[] = "Kyselina hyaluronová";
				$procedures[] = "Aplikace botulotoxinu";
				$procedures[] = "Microneedling";
				break;
			case 'kosmetika':
				$procedures[] = "Silkpeel";
				$procedures[] = "Chemický peeling";
				break;
		}

		$categories = [];

		foreach ($procedures as $procedure) {
			$categories[Strings::webalize($procedure)] = $procedure;
		}

		return $categories;
	}

	private function getArticleForProcedure($procedure)
	{
		$articles = [];
		$articles['plazmaterapie'] = "Tato přirozená metoda využívá vlastní krevní plazmy, která obsahuje živiny potřebné pro pokožku, jako jsou proteiny a krevní destičky s vysokým obsahem růstových faktorů. Přímou aplikací jsou podpořeny regenerační a revitalizační procesy kožních buněk. Prohloubení efektu ošetření může být dosaženo přidáním kyseliny hyaluronové přímo do aplikované krevní pazmy. Plazmaterapie je účinná a přírodní metoda, jejíž pomocí je dosahováno ideálních výsledků při omlazování unavené, povolené pleti s jemnými i hlubokými vráskami.";
		$articles['kyselina-hyaluronova'] = "Je přírodní, tělu vlastní látka, díky níž lze odstranit jizvy po akné, mimické vrásky na obličeji i krku, či vymodelovat a zpevnit kontury tváře. Kyselina hyaluronová se běžně nachází v lidském těle, avšak věkem se její množství přirozeně snižuje. To má za následek vznik mimických vrásek a ochabnutí pleti. Přímou aplikací této je možné dosáhnout výrazného omlazení vzhledu, nebo odstranit nedokonalosti během pár chvil.";
		$articles['aplikace-botulotoxinu'] = "Je nejúčinnější metodou pro odstranění mimických vrásek. Aplikací botulotoxinu do mimických svalů dochází k omezení jejich činnosti, což vede k prevenci tvorby vrásek a vyhlazení vrásek již vzniklých. Díky přesné aplikaci této látky je možno dosáhnout dlouhodobě mladistvého vzhledu. Botulotoxin je vhodný taktéž k řešení problému s pocením v podpaží a na čele.";
		$articles['microneedling'] = "Jedná se o novou, velmi účinnou metodu pro odstranění nežádoucích estetických projevů na pokožce s okamžitým viditelným efektem. Drobné jehličky umožní účinným látkám proniknout pod povrch kůže, čímž je dosaženo lepších a trvalejších výsledků než pouhou vnější aplikací. Revitalizaci pokožky je dosaženo nejen díky vyživujícím látkám, ale i procesu aplikace samotné, která napomáhá zvýšení přirozené tvorby elastinu a kolagenu. Terapie je vhodným způsobem pro redukci vrásek, akné, vyrovnaní nerovností či jizev i odstranění pigmentací na obličeji, v dekoltu na krku nebo hřbetech rukou.";

		$articles['silkpeel'] = "Rychlý, účinný způsob vyčištění a vyživení pleti. Pomocí patentovaného přístroje jsou během chvilky odstraněny nečistoty mnohem účinněji než běžně dostupnými metodami. Následně aplikovaná maska dodá živiny, hydrataci a během pár chvil je dosaženo viditelného zlepšení stavu pleti bez rizika podráždění kůže nebo dlouhotrvajícího zarudnutí.";
		$articles['chemicky-peeling'] = "Je neinvazivní metoda, pro celkové zlepšení kondice a vzhledu pleti. Odstraněním povrchových kožních buněk dochází ke zmenšení pórů, vyhlazení drobných vrásek či jizviček po akné, regulaci tvorby kožního mazu, eliminací akné i pigmentací. Chemický peeling zvyšuje hydrataci a pružnost nejenom na obličeji, ale i na kůži dekoltu nebo hřbetech rukou.";

		return $articles[$procedure];
	}
}