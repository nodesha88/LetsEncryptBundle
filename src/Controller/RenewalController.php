<?php

/**
 * This file is part of the CertLetsEncryptBundle library.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cert\LetsEncryptBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller to handle Let's Encrypt well-known check and renew the certificate.
 */
class RenewalController extends Controller
{
    public function wellKnownAction()
    {
        /** @todo */
        return new Response('OK');
    }
}
