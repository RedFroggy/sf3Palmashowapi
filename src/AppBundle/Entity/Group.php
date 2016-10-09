<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PalmashowGroups
 *
 * @ORM\Table(name="palmashow_groups")
 * @ORM\Entity
 */
class Group
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
     * @ORM\Column(name="iconName", type="string", length=100, nullable=false)
     */
    private $iconname;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=200, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="imageName", type="string", length=300, nullable=false)
     */
    private $imagename;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=200, nullable=false)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Group", mappedBy="parent")
     */
    protected $children;

    /**
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=false)
     */
    private $creationDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sub_groups", type="boolean", nullable=false)
     */
    private $subGroups;

    /**
     * @var string
     *
     * @ORM\Column(name="items", type="string", length=300, nullable=true)
     */
    private $items;

    /**
     * @ORM\OneToMany(
     *      targetEntity="User",
     *      mappedBy="group",
     *      orphanRemoval=true
     * )
     */
    private $users;


    /**
     * @ORM\OneToMany(
     *      targetEntity="Sound",
     *      mappedBy="group",
     *      orphanRemoval=true
     * )
     * @ORM\OrderBy({"creationDate" = "DESC"})
     */
    private $sounds;


    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->sounds = new ArrayCollection();
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
     * Set iconname
     *
     * @param string $iconname
     *
     * @return Group
     */
    public function setIconname($iconname)
    {
        $this->iconname = $iconname;

        return $this;
    }

    /**
     * Get iconname
     *
     * @return string
     */
    public function getIconname()
    {
        return $this->iconname;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Group
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set imagename
     *
     * @param string $imagename
     *
     * @return Group
     */
    public function setImagename($imagename)
    {
        $this->imagename = $imagename;

        return $this;
    }

    /**
     * Get imagename
     *
     * @return string
     */
    public function getImagename()
    {
        return $this->imagename;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Group
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Group
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set subGroups
     *
     * @param boolean $subGroups
     *
     * @return Group
     */
    public function setSubGroups($subGroups)
    {
        $this->subGroups = $subGroups;

        return $this;
    }

    /**
     * Get subGroups
     *
     * @return boolean
     */
    public function getSubGroups()
    {
        return $this->subGroups;
    }

    /**
     * Set items
     *
     * @param string $items
     *
     * @return Group
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Get items
     *
     * @return string
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Add child
     *
     * @param \AppBundle\Entity\Group $child
     *
     * @return Group
     */
    public function addChild(\AppBundle\Entity\Group $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \AppBundle\Entity\Group $child
     */
    public function removeChild(\AppBundle\Entity\Group $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \AppBundle\Entity\Group $parent
     *
     * @return Group
     */
    public function setParent(\AppBundle\Entity\Group $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\Group
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Group
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add sound
     *
     * @param \AppBundle\Entity\Sound $sound
     *
     * @return Group
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
