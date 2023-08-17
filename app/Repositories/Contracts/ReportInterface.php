<?php

namespace App\Repositories\Contracts;

interface ReportInterface
{
    public function setHeader();

    public function setBody($body);

    public function setFooter($pages);
}
