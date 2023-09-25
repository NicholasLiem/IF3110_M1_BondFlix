<?php

namespace Containers;
interface IContainer
{
    public function register($name, $factory);
    public function resolve($name);
}