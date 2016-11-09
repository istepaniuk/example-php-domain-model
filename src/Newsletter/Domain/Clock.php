<?php

namespace Newsletter\Domain;

interface Clock
{
    public function utcNow();
}