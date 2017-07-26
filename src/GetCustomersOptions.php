<?php
namespace ContactHub;

/**
 * ParametersBuilder for filter Customers
 * @package ContactHub
 */
class GetCustomersOptions
{
    private $externalId;
    private $fields = [];
    private $query;
    private $sortBy = '';
    private $direction = '';
    private $page;
    private $size;

    /**
     * @return GetCustomersOptions
     */
    public static function create()
    {
        return new static();
    }

    /**
     * @param string $externalId
     * @return $this
     */
    public function withExternalId($externalId)
    {
        $this->externalId = $externalId;
        return $this;
    }

    /**
     * @param array $fields
     * @return $this
     */
    public function withFields(array $fields)
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @param array $query
     * @return $this
     */
    public function withQuery(array $query)
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @param int $size
     * @return $this
     */
    public function withSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @param string $field
     * @param string $direction
     * @return $this
     */
    public function withSortBy($field, $direction = null)
    {
        if (!in_array($direction, ['', null, 'asc', 'desc'])) {
            throw new \InvalidArgumentException('Direction should be: asc, desc');
        }
        $this->sortBy = $field;
        $this->direction = $direction;
        return $this;
    }

    /**
     * @param int $page
     * @return $this
     */
    public function withPage($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return array_filter([
            'externalId' => $this->externalId,
            'fields' => implode(',', $this->fields),
            'query' => $this->queryToJson(),
            'sort' => implode(',', array_filter([$this->sortBy, $this->direction])),
            'page' => $this->page,
            'size' => $this->size
        ]);
    }

    /**
     * @return string
     */
    private function queryToJson()
    {
        return $this->query ? json_encode($this->query) : null;
    }
}