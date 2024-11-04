<?php

/**
 * @file pages/submission/SubmissionHandler.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class SubmissionHandler
 *
 * @ingroup pages_submission
 *
 * @brief Handles page requests to the submission wizard
 */

namespace APP\pages\revisions;

use APP\components\forms\submission\ReconfigureSubmission;
use APP\components\forms\submission\StartSubmission;
use APP\core\Application;
use APP\core\Request;
use APP\publication\Publication;
use APP\section\Section;
use APP\submission\Submission;
use APP\template\TemplateManager;
use Illuminate\Support\LazyCollection;
use PKP\components\forms\FormComponent;
use PKP\components\forms\publication\Details;
use PKP\components\forms\publication\TitleAbstractForm;
use PKP\components\forms\submission\ForTheEditors;
use PKP\context\Context;
use PKP\facades\Locale;
use PKP\pages\revisions\PKPRevisionsHandler;

class RevisionsHandler extends PKPRevisionsHandler
{

    protected function getDetailsForm(string $publicationApiUrl, array $locales, Publication $publication, Context $context, array $sections, string $suggestionUrlBase): TitleAbstractForm
    {
        /** @var Section $section */
        $section = collect($sections)->first(fn ($section) => $section->getId() === $publication->getData('sectionId'));

        return new Details(
            $publicationApiUrl,
            $locales,
            $publication,
            $context,
            $suggestionUrlBase,
            (int) $section->getData('wordCount'),
            !$section->getData('abstractsNotRequired')
        );
    }

 }
