<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats;

use BeeperDesktop\Chats\ChatCreateParams\Params\UnionMember0;
use BeeperDesktop\Chats\ChatCreateParams\Params\UnionMember1;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Create a single/group chat (mode='create') or start a direct chat from merged user data (mode='start').
 *
 * @see BeeperDesktop\Services\ChatsService::create()
 *
 * @phpstan-import-type ParamsVariants from \BeeperDesktop\Chats\ChatCreateParams\Params
 * @phpstan-import-type ParamsShape from \BeeperDesktop\Chats\ChatCreateParams\Params
 *
 * @phpstan-type ChatCreateParamsShape = array{params?: ParamsShape|null}
 */
final class ChatCreateParams implements BaseModel
{
    /** @use SdkModel<ChatCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var ParamsVariants|null $params */
    #[Optional]
    public UnionMember0|UnionMember1|null $params;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ParamsShape|null $params
     */
    public static function with(
        UnionMember0|array|UnionMember1|null $params = null
    ): self {
        $self = new self;

        null !== $params && $self['params'] = $params;

        return $self;
    }

    /**
     * @param ParamsShape $params
     */
    public function withParams(UnionMember0|array|UnionMember1 $params): self
    {
        $self = clone $this;
        $self['params'] = $params;

        return $self;
    }
}
