<?php

namespace App\Entity;

class TrafficSplitEntity
{
    protected int $chucklePayWeight = 0;
    protected int $cosmicPayWeight = 0;
    protected int $giggleGuardWeight = 0;
    protected int $witWalletWeight = 0;

    /**
     * @return int
     */
    public function getChucklePayWeight(): int
    {
        return $this->chucklePayWeight;
    }

    /**
     * @param int $chucklePayWeight
     */
    public function setChucklePayWeight(int $chucklePayWeight): void
    {
        $this->chucklePayWeight = $chucklePayWeight;
    }

    /**
     * @return int
     */
    public function getCosmicPayWeight(): int
    {
        return $this->cosmicPayWeight;
    }

    /**
     * @param int $cosmicPayWeight
     */
    public function setCosmicPayWeight(int $cosmicPayWeight): void
    {
        $this->cosmicPayWeight = $cosmicPayWeight;
    }

    /**
     * @return int
     */
    public function getGiggleGuardWeight(): int
    {
        return $this->giggleGuardWeight;
    }

    /**
     * @param int $giggleGuardWeight
     */
    public function setGiggleGuardWeight(int $giggleGuardWeight): void
    {
        $this->giggleGuardWeight = $giggleGuardWeight;
    }

    /**
     * @return int
     */
    public function getWitWalletWeight(): int
    {
        return $this->witWalletWeight;
    }

    /**
     * @param int $witWalletWeight
     */
    public function setWitWalletWeight(int $witWalletWeight): void
    {
        $this->witWalletWeight = $witWalletWeight;
    }
}
