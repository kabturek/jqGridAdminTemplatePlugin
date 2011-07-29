[?php use_helper('I18N', 'Date') ?]
[?php
$results = array();
foreach ($pager->getResults() as $i => $<?php echo $this->getSingularName() ?>){
  $results[$i] = array(
    'id' => $<?php echo $this->getSingularName();?>->id,
    'cell' => array()
  );
<?php foreach ($this->configuration->getValue('list.display') as $name => $field): ?>
<?php echo $this->addCredentialCondition(sprintf(<<<'EOF'
   $results[$i]['cell'][] =  %s ;

EOF
, $this->renderField($field)), $field->getConfig()) ?>
<?php endforeach; ?>
}
$ret = array( 
  "total" => $pager->getNbResults(), 
  "page" => $pager->getPage(), 
  "records" => count($results), 
  "rows" => $results,
);
echo json_encode($ret);
