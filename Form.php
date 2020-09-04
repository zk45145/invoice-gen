<?php

class Form
{
    public function getTag(string $tag, string $text): string
    {
        return '<' . $tag . '>' . $text . '</' . $tag . '>';
    }

    public function header(string $text): string
    {
        return '<h2>' . $text . '</h2>';
    }

    public function list($elements) {
        $ret = '<ul>';
        foreach ($elements as $element) {
            $ret .= '<li>' . $element . '</li>';
        }
        $ret .= '</ul>';

        return $ret;
    }

    public function tableBegin()
    {
        return '<table class="table">';
    }

    public function tableEnd()
    {
        return '</table>';
    }


    public function row($data)
    {
        $ret = '';
        $ret .= '<tr>';
        foreach ($data as $position) {
            $ret .= $this->getTag('td', $position);
        }
        $ret .= '</tr>';

        return $ret;
    }

    public function input($name, $value, $type = 'text')
    {
        return '<input name="' . $name . '" value="' . $value . '" type="' . $type . '" class="form-control"/>';
        
    }

    public function formBegin($action, $method = 'POST')
    {

        return '<form action="' . $action . '" method="' . $method . '">';
    }

    public function formEnd()
    {
        return '</form>';
    }

    public function submit($value)
    {
        return '<p><input class = "btn btn-primary btn-lg" type="submit" value="' . $value . '"/></p>';
    }

    public function select($name, $options, $selectValue = null)
    {
        $ret = '';
        $ret .= '<select name="' . $name . '" class="form-control">';
        foreach ($options as $option) {
            $ret .= '<option>' . $option . '</option>';
        }
        $ret .= '</select>';

        return $ret;
    }
}