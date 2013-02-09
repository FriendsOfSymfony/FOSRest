<?php

/*
 * This file is part of the FOSRest package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\Rest\Tests\Decoder;

use FOS\Rest\Decoder\JsonToFormDecoder;

/**
 * Tests the form like encoder
 * 
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class JsonToFormDecoderTest extends \PHPUnit_Framework_TestCase
{

    public function testDecode()
    {
        $data = array(
            'arrayKey' => array(
                'falseKey' => false,
                'stringKey' => 'foo'
            ),
            'falseKey' => false,
            'trueKey' => true,
            'intKey' => 69,
            'floatKey' => 3.14,
            'stringKey' => 'bar',
        );
        $decoder = new JsonToFormDecoder();
        $decoded = $decoder->decode(json_encode($data));

        $this->assertTrue(is_array($decoded));
        $this->assertTrue(is_array($decoded['arrayKey']));
        $this->assertArrayNotHasKey('falseKey', $decoded['arrayKey']);
        $this->assertEquals('foo', $decoded['arrayKey']['stringKey']);
        $this->assertArrayNotHasKey('falseKey', $decoded);
        $this->assertEquals('1', $decoded['trueKey']);
        $this->assertEquals('69', $decoded['intKey']);
        $this->assertEquals('3.14', $decoded['floatKey']);
        $this->assertEquals('bar', $decoded['stringKey']);
    }

}