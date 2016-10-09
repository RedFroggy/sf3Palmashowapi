<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PalmashowUsers
 *
 * @ORM\Table(name="palmashow_users")
 * @ORM\Entity
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="thumbtail", type="string", length=500, nullable=false)
     */
    private $thumbtail;

    /**
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="users")
     * @ORM\JoinColumn(nullable=true)
     */
    private $group;

    /**
     * @ORM\OneToMany(
     *      targetEntity="Sound",
     *      mappedBy="user",
     *      orphanRemoval=true
     * )
     */
    private $sounds;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sounds = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set thumbtail
     *
     * @param string $thumbtail
     *
     * @return User
     */
    public function setThumbtail($thumbtail)
    {
        $this->thumbtail = $thumbtail;

        return $this;
    }

    /**
     * Get thumbtail
     *
     * @return string
     */
    public function getThumbtail()
    {
        return $this->thumbtail;
    }

    /**
     * Set group
     *
     * @param \AppBundle\Entity\Group $group
     *
     * @return User
     */
    public function setGroup(\AppBundle\Entity\Group $group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \AppBundle\Entity\Group
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Add sound
     *
     * @param \AppBundle\Entity\Sound $sound
     *
     * @return User
     */
    public function addSound(\AppBundle\Entity\Sound $sound)
    {
        $this->sounds[] = $sound;

        return $this;
    }

    /**
     * Remove sound
     *
     * @param \AppBundle\Entity\Sound $sound
     */
    public function removeSound(\AppBundle\Entity\Sound $sound)
    {
        $this->sounds->removeElement($sound);
    }

    /**
     * Get sounds
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSounds()
    {
        return $this->sounds;
    }
}
