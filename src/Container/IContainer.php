<?php

namespace Container;
interface IContainer
{
    public function register($name, $factory);
    public function resolve($name);
}