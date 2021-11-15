<?php


class Collection
{

    /**
     * @var array|iterable
     */
    private $items;

    public function __construct(iterable $items = [])
    {

        $this->items = $items;
    }

    /**
     * @return array|iterable
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->items);
    }

    /**
     * @param null $default
     * @return mixed|null
     */
    public function first($default = null)
    {
        return isset($this->items[0]) ? $this->items[0] : $default;
    }

    /**
     * @param null $default
     * @return mixed|null
     */
    public function last($default = null)
    {
        $reversed = array_reverse($this->items);
        return isset($reversed[0]) ? $reversed[0] : $default;
    }

    /**
     * @param callable $callback
     */
    public function each(callable $callback)
    {
        foreach ($this->items as $key => $value) {
            $callback($value, $key);
        }
    }

    public function keys(){
        return new static(array_keys($this->items));
    }
    public function filter(callable $callback =null){
        if ($callback){
            return new static(array_filter($this->items,$callback));
        }
        return new static(array_filter($this->items));
    }

    public function map(callable $callback){
        $keys = $this->keys()->all();
        $mapped = array_map($callback,$this->items,$keys);

        return new static(array_combine($keys,$mapped));
    }
}
