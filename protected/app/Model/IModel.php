<?php

namespace app\Model;

/**
 *
 * @author haivoronskyi.oleksandr@gmail.com
 */
interface IModel
{
    public function tableName(): string;

    public function validate(): bool;

    public function save(): bool;

    public function getErrors(): array;

    public function getErrorsToString(): string;

    public function getError(string $attributeName): array;
}
