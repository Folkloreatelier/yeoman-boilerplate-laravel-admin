<?php namespace App\Request;

use Illuminate\Support\Collection;

class QueryString extends Collection
{
    
    /**
     * Create a new collection instance if the value isn't one already.
     *
     * @param  mixed  $items
     * @return static
     */
    public static function make($items = '')
    {
        if(is_string($items)) {
            if(empty($items)) {
                $items = $_SERVER['QUERY_STRING'];
            }
            parse_str($items,$query);
            $items = $query;
        }
        
        return parent::make($items);
    }
    
    /**
     * Return a collection without the specified keys
     *
     * @param  array  $keys
     * @return static
     */
    public function without($keys)
    {
        $keys = (array)$keys;
        $items = array();
        foreach($this->items as $key => $value)
        {
            if(!in_array($key,$keys))
            {
                $items[$key] = $value;
            }
        }
        return new static($items);
    }
    
    /**
     * Return a collection with only the specified keys
     *
     * @param  array  $keys
     * @return static
     */
    public function only($keys)
    {
        $keys = (array)$keys;
        $items = array();
        foreach($this->items as $key => $value)
        {
            if(in_array($key,$keys))
            {
                $items[$key] = $value;
            }
        }
        return new static($items);
    }
    
    /**
     * Return a collection with the key replaced
     *
     * @param  array  $keys
     * @return static
     */
    public function replace($key, $value = null)
    {
        $replace = is_array($key) ? $key:array($key=>$value);
        $items = $this->items;
        foreach($replace as $key => $value) {
            $items[$key] = $value;
        }
        return new static($items);
    }
    
    /**
     * Return a collection with the key replaced
     *
     * @param  array  $keys
     * @return static
     */
    public function is($key, $value = null)
    {
        return isset($this->items[$key]) && $this->items[$key] == $value;
    }

    /**
     * Convert the collection to its string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toQueryString();
    }

    /**
     * Convert the collection to its string representation.
     *
     * @return string
     */
    public function toQueryString()
    {
        $queryString = http_build_query($this->items);
        if(!empty($queryString)) $queryString = '?'.$queryString;
        
        return $queryString;
    }
    
}
