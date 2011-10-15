[?php use_helper('I18N', 'Date') ?]
[?php
$results = array();
foreach ($pager->getResults() as $i => $<?php echo $this->getSingularName() ?>){
  $results[$i] = array(
    'id' => $<?php echo $this->getSingularName();?>->id,
    'cell' => array()
  );
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
            $results[$i]['cell'][] = get_partial('<?php echo $this->getModuleName() ?>/list_json_batch_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'helper' => $helper)); 
<?php endif; ?>
<?php foreach ($this->configuration->getValue('list.display') as $name => $field): ?>
<?php echo $this->addCredentialCondition(sprintf(<<<'EOF'
   $results[$i]['cell'][] =  %s ;

EOF
, $this->renderField($field)), $field->getConfig()) ?>
<?php endforeach; ?>
            $results[$i]['cell'][] = get_partial('<?php echo $this->getModuleName() ?>/list_json_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'helper' => $helper)); 
}
$ret = array( 
  "total" => $pager->getLastPage(), 
  "page" => $pager->getPage(), 
  "records" => $pager->getNbResults(), 
  "rows" => $results,
);
echo json_encode($ret);
