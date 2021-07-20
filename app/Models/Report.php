<?php

namespace App\Models;

class Report
{
    public int $id;
    public string $title;
    public string $body;
    public int $userId;
    public ?string $image = null;
}