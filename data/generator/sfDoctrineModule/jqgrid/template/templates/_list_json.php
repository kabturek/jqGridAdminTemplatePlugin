[?php
$results = array();
foreach($pager->getResults() as $i => $result){
  $results[$i] = array(
    'id' => $result->id,
    'cell' => array()
  );
  foreach ($this->configuration->getValue('list.display') as $name => $field){
    $results[$i]['cell'][] = $this->renderField($field);
  }
}
$ret = json_encode(array( 
  "total" => $pager->getNbResults(), 
  "page" => $pager->getPage(), 
  "records" => count($results), 
  "rows" => $results,
));
echo json_encode($ret);
