<?php

namespace Kanel\Dynamic\CodingStyle;

interface CodingStyleInterface
{
    public function useBom();

    public function getEncoding();

    public function usePhpClosingTag();

    public function getIndentation();

    public function isClassBracesInNewLine();

    public function isMethodBracesInNewLine();

    public function getNewLine();
}
