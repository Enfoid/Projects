<?

//print_r($TradeStats);

//$products['total'] = 23;
//$products['trades'] = 753;

$products['settings']['MFXBshowstatement'] = false; // show myfxbook Statement Link
$products['settings']['MFXBshowtrades'] = true; // myfxbook trades window
$products['settings']['showBalance'] = true; // show account balance
$products['settings']['BackupFundsLevel'] = 0; // show use of backup funds (percentage of the fund backup used)

$products['items'] = array( // total trades per pair
					'US2000' => 7371,
					);

$A = file_get_contents(ULOCAL."lib/3rd/myfxbook/GetMyfxbookStats.php?totals=include&id=".$account);
$TradeStats = json_decode($A, true); unset($A);

$img = URI.@$TradeStats['statimage'];
if ((!is_file($img)) || (filesize($img) <100)) {
        $img = URL.'assets/strategies/'.$account.'/growth-chart.png';
}
else {
        $img = URL.$TradeStats['statimage'];
}

$products['stats'] = array(
	'trades' => 7384,
	'profitability' => 64,
	'avg-win-pip' => 57.50,
	'avg-loss-pip' => -165.82,
	'lots' =>	47097.49,
	'win-long' =>	64,		// % value of winners
	'short-win' =>	63,		// % value of winners
	'avg-trade-length' =>	'2h 29m',

	'pips' => @$TradeStats['pips'],
	'profit-factor' => @$TradeStats['profitfactor'],
	'gain' => round((@$TradeStats['gain']-100),2),				// general stats
	'abs-gain' => round((@$TradeStats['absGain']-100),2),			// general stats
	'dd' => @$TradeStats['drawdown'],				// general stats
	'avg-daily' => @$TradeStats['avg-day'],		// general stats
	'avg-monthly' => @$TradeStats['avg-month'],		// general stats
	'lifetime' => @$TradeStats['lifetime'], 	// get from http://localhost/Code/Projects/trade/swingfish.trade/assets/ventor/myfxbook/myfxbhtml.php
	'lastupdate' => @$TradeStats['lastupdate'],
	'gain-today' => @$TradeStats['today']['gain'],
	'currency' => @$TradeStats['currency'],
	'balance' => @$TradeStats['balance'],
	'MFXBaccount' => $account,
	'image' => $img,
	'raw' => $TradeStats, // tihis is just so i not have to add  all fields to all fines while development
	);

