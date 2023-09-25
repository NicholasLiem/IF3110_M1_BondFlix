<?php

namespace Utils;

interface IUploader
{
    public function upload($path, $type);
}