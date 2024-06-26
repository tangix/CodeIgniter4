<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace CodeIgniter\Models;

use PHPUnit\Framework\Attributes\Group;
use Tests\Support\Models\UserModel;

/**
 * @internal
 */
#[Group('DatabaseLive')]
final class AffectedRowsTest extends LiveModelTestCase
{
    /**
     * @see https://github.com/codeigniter4/CodeIgniter4/issues/5137
     */
    public function testAffectedRowsWithEmptyUpdate(): void
    {
        $this->createModel(UserModel::class);
        $notExistsId = -1;
        $this->model
            ->set('country', 'US')
            ->where('id', $notExistsId)
            ->update();

        $this->assertSame(0, $this->model->affectedRows());
    }
}
