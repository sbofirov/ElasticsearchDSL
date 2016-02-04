<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\Suggest;

class TermSuggest extends AbstractSuggest
{
    const DEFAULT_SIZE = 3;

    public function __construct($name, $text, $parameters = [])
    {
        $this->setName($name);
        $this->setText($text);
        $this->setParameters($parameters);
    }

    /**
     * Returns element type.
     *
     * @return string
     */
    public function getType()
    {
        return 'term';
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        if (!$this->hasParameter('field')) {
            $this->addParameter('field', '_all');
        }

        if (!$this->hasParameter('size')) {
            $this->addParameter('size', self::DEFAULT_SIZE);
        }

        $output = [
            $this->getName() => [
                'text' => $this->getText(),
                'term' => $this->getParameters(),
            ]
        ];

        return $output;
    }
}
