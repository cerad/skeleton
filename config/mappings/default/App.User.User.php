<?php declare(strict_types=1);

use App\User\UserMapper;

/** @var  Doctrine\ORM\Mapping\ClassMetadata $metadata */
$metadata = isset($metadata) ? $metadata : null;

(new UserMapper($metadata))();

return;
