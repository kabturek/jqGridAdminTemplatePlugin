  public function executeIndex(sfWebRequest $request)
  {
    // sorting
    if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
    {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }

    // pager
    if ($request->getParameter('page'))
    {
      $this->setPage($request->getParameter('page'));
    }
    //max per page
    if ($request->getParameter('rows'))
    {
      $this->setMaxPerPage($request->getParameter('rows'));
    }
    
    if($request->getParameter('_search', false)){
        $this->parseSearch($request);

    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
    // pager
    if($request->isXmlHttpRequest()){
      $this->setTemplate('jsonIndex');
    }
  }
  protected function parseSearch(sfWebRequest $request){
    $filters = array();
    foreach($this->configuration->getFilterDisplay() as $i => $filter){
      if($request->getParameter($filter)){
        $filters[$filter] = array('text' => $request->getParameter($filter));
      }
    }
    $this->filters = $this->configuration->getFilterForm($this->getFilters());
    $request->setParameter($this->filters->getName(), $filters);

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());
    }
  }
