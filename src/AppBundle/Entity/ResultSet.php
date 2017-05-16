<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Movie
 *
 * @ORM\Table(name="result_set")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MovieRepository")
 */
class ResultSet
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
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="result", type="text")
     */
    private $result;

    /**
     * @var Movie[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Movie", mappedBy="resultSet")
     */
    private $movieResults;

    /**
     * ResultSet constructor.
     */
    public function __construct()
    {
        $this->movieResults = new ArrayCollection();
    }

    /**
     * @param Movie $movie
     */
    public function addMovie(Movie $movie)
    {
        $this->movieResults->add($movie);
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
     * @param string $name
     *
     * @return ResultSet
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
     * @return Movie[]
     */
    public function getMovieResults()
    {
        return $this->movieResults;
    }


    /**
     * Set result
     *
     * @param string $result
     *
     * @return ResultSet
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result
     *
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }
}

