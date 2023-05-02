<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface ReportInterface
{
    public function setHeader($title);

    public function setBody($body);

    public function setFooter($pages);
}
