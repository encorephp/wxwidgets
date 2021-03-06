<?php

namespace Encore\Wx\Element;

use wxBoxSizer;
use Encore\Giml\ElementTrait;
use Encore\Wx\Element\Traits\Wx;
use Encore\Giml\ElementInterface;

class BoxSizer implements ElementInterface
{
    use ElementTrait;
    use Wx;

    /**
     * Initialise the object
     * 
     * @return void
     */
    public function init()
    {
        $this->element = new wxBoxSizer($this->orientation == 'horizontal'
            ? wxHORIZONTAL
            : wxVERTICAL);

        if ($this->parent instanceof Frame) {
            $this->parent->getRaw()->SetSizer($this->getRaw());
        } elseif ($this->parent instanceof static) {
            $this->parent->getRaw()->Add($this->getRaw());
        }
    }

    /**
     * Set the an element attribute
     * 
     * @param string $key
     * @param mixed $value
     */
    public function setAttribute($key, $value)
    {
        switch ($key) {
            case 'orientation':
                $this->attributes[$key] = 
                    $value == 'horizontal' ?
                    wxHORIZONTAL :
                    wxVERTICAL
                ;
            default:
                $this->attributes[$key] = $value;
            break;
        }
    }
}