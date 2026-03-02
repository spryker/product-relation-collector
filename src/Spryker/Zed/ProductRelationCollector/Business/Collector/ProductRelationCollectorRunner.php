<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductRelationCollector\Business\Collector;

use Generated\Shared\Transfer\LocaleTransfer;
use Orm\Zed\Touch\Persistence\SpyTouchQuery;
use Spryker\Zed\Collector\Business\Collector\DatabaseCollectorInterface;
use Spryker\Zed\Collector\Business\Exporter\Reader\ReaderInterface;
use Spryker\Zed\Collector\Business\Exporter\Writer\TouchUpdaterInterface;
use Spryker\Zed\Collector\Business\Exporter\Writer\WriterInterface;
use Spryker\Zed\Collector\Business\Model\BatchResultInterface;
use Spryker\Zed\ProductRelationCollector\Dependency\Facade\ProductRelationCollectorToCollectorInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductRelationCollectorRunner implements ProductRelationCollectorRunnerInterface
{
    /**
     * @var \Spryker\Zed\Collector\Business\Collector\DatabaseCollectorInterface
     */
    protected $collector;

    /**
     * @var \Spryker\Zed\ProductRelationCollector\Dependency\Facade\ProductRelationCollectorToCollectorInterface
     */
    protected $collectorFacade;

    public function __construct(
        DatabaseCollectorInterface $collector,
        ProductRelationCollectorToCollectorInterface $collectorFacade
    ) {
        $this->collector = $collector;
        $this->collectorFacade = $collectorFacade;
    }

    public function run(
        SpyTouchQuery $baseQuery,
        LocaleTransfer $localeTransfer,
        BatchResultInterface $result,
        ReaderInterface $dataReader,
        WriterInterface $dataWriter,
        TouchUpdaterInterface $touchUpdater,
        OutputInterface $output
    ): void {
        $this->collectorFacade->runCollector(
            $this->collector,
            $baseQuery,
            $localeTransfer,
            $result,
            $dataReader,
            $dataWriter,
            $touchUpdater,
            $output,
        );
    }
}
