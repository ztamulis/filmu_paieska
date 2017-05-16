<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Movie
 *
 * @ORM\Table(name="movie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MovieRepository")
 */
class Movie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="overview", type="text")
     */
    private $overview;

    /**
     * @var string
     *
     * @ORM\Column(name="originalName", type="string", length=255)
     */
    private $originalName;

    /**
     * @var Movie
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ResultSet", inversedBy="movieResults")
     */
    private $resultSet;

    /**
     * @var string
     *
     * @ORM\Column(name="releaseDate", type="string", length=255)
     */
    private $releaseDate;

    /**
     * @return Movie
     */
    public function getResultSet()
    {
        return $this->resultSet;
    }

    /**
     * @param ResultSet $resultSet
     *
     * @return Movie
     */
    public function setResultSet($resultSet)
    {
        $this->resultSet = $resultSet;

        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $title
     *
     * @return Movie
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set overview
     *
     * @param string $overview
     *
     * @return Movie
     */
    public function setOverview($overview)
    {
        $this->overview = $overview;

        return $this;
    }

    /**
     * Set originalName
     *
     * @param string $originalName
     *
     * @return Movie
     */
    public function setOriginalName($originalName)
    {
        $this->originalName = $originalName;

        return $this;
    }
    /**
     * Set ReleaseDate
     *
     * @param string $ReleaseDate
     *
     * @return Movie
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get overview
     *
     * @return string
     */
    public function getOverview()
    {
        return $this->overview;
    }

    /**
     * Get ReleaseDate
     *
     * @return string
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }
    /**
     * Get originalName
     *
     * @return string
     */
    public function getOriginalName()
    {
        return $this->originalName;
    }
}


