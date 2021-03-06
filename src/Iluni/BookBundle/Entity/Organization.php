<?php

namespace Iluni\BookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\ExecutionContext;

/**
 * Iluni\BookBundle\Entity\Organization
 */
class Organization
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $prefix
     */
    private $prefix;

    /**
     * @var string $suffix
     */
    private $suffix;

    /**
     * @var text $note
     */
    private $note;

    /**
     * @var string $fullname
     */
    private $fullname;

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
     * @return Organization
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
     * Set prefix
     *
     * @param string $prefix
     * @return Organization
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set suffix
     *
     * @param string $suffix
     * @return Organization
     */
    public function setSuffix($suffix)
    {
        $this->suffix = $suffix;
        return $this;
    }

    /**
     * Get suffix
     *
     * @return string
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * Set note
     *
     * @param text $note
     * @return Organization
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }

    /**
     * Get note
     *
     * @return text
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set fullname
     *
     * @param string $fullname
     * @return Organization
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    public function setFullnameValue()
    {
        $prefix = $this->prefix;
        $suffix = $this->suffix;
        $name = $this->name;

        if (!empty($prefix)) {
            $name = $prefix.' '.$name;
        }
        if (!empty($suffix)) {
            $name = $name.', '.$suffix;
        }

        $this->fullname = $name;
    }

    public function __toString()
    {
        return $this->getName();
    }
    /**
     * @var datetime $created
     */
    private $created;

    /**
     * @var datetime $updated
     */
    private $updated;


    /**
     * Set created
     *
     * @param datetime $created
     * @return Organization
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return datetime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param datetime $updated
     * @return Organization
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * Get updated
     *
     * @return datetime
     */
    public function getUpdated()
    {
        return $this->updated;
    }
    /**
     * @var integer $lft
     */
    private $lft;

    /**
     * @var integer $rgt
     */
    private $rgt;

    /**
     * @var integer $root
     */
    private $root;

    /**
     * @var integer $lvl
     */
    private $lvl;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $children;

    /**
     * @var Iluni\BookBundle\Entity\Organization
     */
    private $parent;

    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set lft
     *
     * @param integer $lft
     * @return Organization
     */
    public function setLft($lft)
    {
        $this->lft = $lft;
        return $this;
    }

    /**
     * Get lft
     *
     * @return integer
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     * @return Organization
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;
        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set root
     *
     * @param integer $root
     * @return Organization
     */
    public function setRoot($root)
    {
        $this->root = $root;
        return $this;
    }

    /**
     * Get root
     *
     * @return integer
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     * @return Organization
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;
        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Add children
     *
     * @param Iluni\BookBundle\Entity\Organization $children
     */
    public function addOrganization(\Iluni\BookBundle\Entity\Organization $children)
    {
        $this->children[] = $children;
    }

    /**
     * Get children
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param Iluni\BookBundle\Entity\Organization $parent
     * @return Organization
     */
    public function setParent(\Iluni\BookBundle\Entity\Organization $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return Iluni\BookBundle\Entity\Organization
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param Iluni\BookBundle\Entity\Organization $children
     * @return Organization
     */
    public function addChildren(\Iluni\BookBundle\Entity\Organization $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param Iluni\BookBundle\Entity\Organization $children
     */
    public function removeChildren(\Iluni\BookBundle\Entity\Organization $children)
    {
        $this->children->removeElement($children);
    }

    public function isParentValid(ExecutionContext $context)
    {
        if ($this->getParent()) {
            $parent = $this->getParent();
            if ($this->getId()==$parent->getId()) {
                $message = 'An organization cannot be made a descendent of itself.!';
                $context->addViolationAtSubPath('parent', $message, array(), null);
                $context->addViolationAtSubPath('name', 'The child cannot match parent!', array(), null);
            }
        }
    }
    /**
     * @var string $slug
     */
    private $slug;


    /**
     * Set slug
     *
     * @param string $slug
     * @return Organization
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
}