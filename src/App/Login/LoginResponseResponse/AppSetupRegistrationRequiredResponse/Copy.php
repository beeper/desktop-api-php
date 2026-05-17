<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login\LoginResponseResponse\AppSetupRegistrationRequiredResponse;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Copy to display during account creation.
 *
 * @phpstan-type CopyShape = array{
 *   submit: 'Continue',
 *   terms: 'By continuing, you agree to the Terms of Use and acknowledge the Privacy Policy.',
 *   title: 'Choose your username',
 *   usernamePlaceholder: 'Username',
 * }
 */
final class Copy implements BaseModel
{
    /** @use SdkModel<CopyShape> */
    use SdkModel;

    /**
     * Submit button label.
     *
     * @var 'Continue' $submit
     */
    #[Required]
    public string $submit = 'Continue';

    /**
     * Terms and privacy notice to show before account creation.
     *
     * @var 'By continuing, you agree to the Terms of Use and acknowledge the Privacy Policy.' $terms
     */
    #[Required]
    public string $terms = 'By continuing, you agree to the Terms of Use and acknowledge the Privacy Policy.';

    /**
     * Title for the username step.
     *
     * @var 'Choose your username' $title
     */
    #[Required]
    public string $title = 'Choose your username';

    /**
     * Placeholder for the username field.
     *
     * @var 'Username' $usernamePlaceholder
     */
    #[Required]
    public string $usernamePlaceholder = 'Username';

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(): self
    {
        return new self;
    }

    /**
     * Submit button label.
     *
     * @param 'Continue' $submit
     */
    public function withSubmit(string $submit): self
    {
        $self = clone $this;
        $self['submit'] = $submit;

        return $self;
    }

    /**
     * Terms and privacy notice to show before account creation.
     *
     * @param 'By continuing, you agree to the Terms of Use and acknowledge the Privacy Policy.' $terms
     */
    public function withTerms(string $terms): self
    {
        $self = clone $this;
        $self['terms'] = $terms;

        return $self;
    }

    /**
     * Title for the username step.
     *
     * @param 'Choose your username' $title
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Placeholder for the username field.
     *
     * @param 'Username' $usernamePlaceholder
     */
    public function withUsernamePlaceholder(string $usernamePlaceholder): self
    {
        $self = clone $this;
        $self['usernamePlaceholder'] = $usernamePlaceholder;

        return $self;
    }
}
