<?php

declare(strict_types=1);

/*
 * This file is part of the ilias-plugin-utils Library for ILIAS.
 *
 * (c) Thomas Joußen <tjoussen@databay.de>
 *
 * This source file is subject to the GPL-3.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Thojou\Ilias\Plugin\Utils\Test\Traits;

use ilCtrl;
use ilGlobalTemplate;
use ILIAS\Data\Factory as DataFactory;
use ILIAS\Refinery\Factory as Refinery;
use ilLanguage;
use ilObjUser;
use ilStyleDefinition;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Http\Message\ServerRequestInterface;

/**
 * CommonHelperTrait
 *
 * This trait provides common helper methods and properties for testing ILIAS plugins.
 * It includes methods for registering and mocking various ILIAS core services and components.
 *
 * @author Thomas Joußen <tjoussen@databay.de>
 */
trait CommonHelperTrait
{
    /**
     * @var Refinery The Refinery instance.
     */
    protected Refinery $refinery;

    /**
     * @var ilGlobalTemplate&MockObject The mocked template object.
     */
    protected ilGlobalTemplate $tpl;

    /**
     * @var ilCtrl&MockObject The mocked control object.
     */
    protected ilCtrl $ctrl;

    /**
     * @var ilLanguage&MockObject The mocked language object.
     */
    protected MockObject $language;

    /**
     * @var ServerRequestInterface&MockObject The mocked HTTP server request object.
     */
    protected ServerRequestInterface $request;

    /**
     * @var ilStyleDefinition&MockObject The mocked style definition object.
     */
    protected ilStyleDefinition $styleDefinition;

    /**
     * @var ilObjUser&MockObject The mocked user object.
     */
    protected ilObjUser $user;

    /**
     * Register the Refinery instance and configure the core service to use it.
     *
     * @return Refinery The registered Refinery instance.
     */
    public function registerRefinery(): Refinery
    {
        $this->refinery = new Refinery(
            new DataFactory(),
            $this->language ?? $this->registerLanguage()
        );

        $this->mockCoreService('refinery', $this->refinery);

        return $this->refinery;
    }

    /**
     * Register and mock the language object.
     *
     * @return ilLanguage&MockObject The registered and mocked language object.
     */
    public function registerLanguage(): ilLanguage
    {
        $this->language = $this->createMock(ilLanguage::class);

        $this->mockCoreService('lng', $this->language);

        return $this->language;
    }

    /**
     * Register and mock the global template object.
     *
     * @return ilGlobalTemplate&MockObject The registered and mocked global template object.
     */
    public function registerTemplate(): ilGlobalTemplate
    {
        $this->tpl = $this->createMock(ilGlobalTemplate::class);

        $this->mockCoreService('tpl', $this->tpl);

        return $this->tpl;
    }

    /**
     * Register and mock the control object.
     *
     * @return ilCtrl&MockObject The registered and mocked control object.
     */
    public function registerCtrl(): ilCtrl
    {
        $this->ctrl = $this->createMock(ilCtrl::class);

        $this->mockCoreService('ilCtrl', $this->ctrl);

        return $this->ctrl;
    }

    /**
     * Register and mock the style definition object.
     *
     * @return ilStyleDefinition&MockObject The registered and mocked style definition object.
     */
    public function registerStyleDefinition(): ilStyleDefinition
    {
        $this->styleDefinition = $this->createMock(ilStyleDefinition::class);

        $this->mockCoreService('styleDefinition', $this->styleDefinition);

        return $this->styleDefinition;
    }

    /**
     * Register and mock the user object.
     *
     * @return ilObjUser&MockObject The registered and mocked user object.
     */
    public function registerUser(): ilObjUser
    {
        $this->user = $this->createMock(ilObjUser::class);

        $this->mockCoreService('ilUser', $this->user);

        return $this->user;
    }

    /**
     * Set up common components and services used in GUI tests.
     */
    public function setupGUICommons(): void
    {
        $this->registerCtrl();
        $this->registerLanguage();
        $this->registerRefinery();
        $this->registerStyleDefinition();
        $this->registerTemplate();
        $this->registerUser();
    }
}
