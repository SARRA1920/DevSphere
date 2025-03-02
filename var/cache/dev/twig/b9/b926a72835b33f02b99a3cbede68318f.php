<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* public/categorie_cours/show.html.twig */
class __TwigTemplate_7afef8be7683bfa3f2056fe4d864c52c extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "public/categorie_cours/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "public/categorie_cours/show.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "public/categorie_cours/show.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 3, $this->source); })()), "nom", [], "any", false, false, false, 3), "html", null, true);
        yield " - Courses";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 6
        yield "    <!-- Header Start -->
    <div class=\"container-fluid bg-primary py-5 mb-5 page-header\">
        <div class=\"container py-5\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-10 text-center\">
                    <h1 class=\"display-3 text-white animated slideInDown\">";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 11, $this->source); })()), "nom", [], "any", false, false, false, 11), "html", null, true);
        yield "</h1>
                    <nav aria-label=\"breadcrumb\">
                        <ol class=\"breadcrumb justify-content-center\">
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"";
        // line 14
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\">Home</a></li>
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"";
        // line 15
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("public_categorie_cours_index");
        yield "\">Categories</a></li>
                            <li class=\"breadcrumb-item text-white active\" aria-current=\"page\">";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 16, $this->source); })()), "nom", [], "any", false, false, false, 16), "html", null, true);
        yield "</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Courses Start -->
    <div class=\"container-xxl py-5\">
        <div class=\"container\">
            <div class=\"text-center wow fadeInUp\" data-wow-delay=\"0.1s\">
                <h6 class=\"section-title bg-white text-center text-primary px-3\">Courses</h6>
                <h1 class=\"mb-5\">";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["category"]) || array_key_exists("category", $context) ? $context["category"] : (function () { throw new RuntimeError('Variable "category" does not exist.', 30, $this->source); })()), "nom", [], "any", false, false, false, 30), "html", null, true);
        yield " Courses</h1>
            </div>
            <div class=\"row g-4 justify-content-center\">
                ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["courses"]) || array_key_exists("courses", $context) ? $context["courses"] : (function () { throw new RuntimeError('Variable "courses" does not exist.', 33, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["course"]) {
            // line 34
            yield "                    <div class=\"col-lg-4 col-md-6 wow fadeInUp\" data-wow-delay=\"0.1s\">
                        <div class=\"course-item bg-light\">
                            <div class=\"position-relative overflow-hidden\">
                                ";
            // line 37
            if (CoreExtension::getAttribute($this->env, $this->source, $context["course"], "image", [], "any", false, false, false, 37)) {
                // line 38
                yield "                                    <img class=\"img-fluid\" src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/courses/" . CoreExtension::getAttribute($this->env, $this->source, $context["course"], "image", [], "any", false, false, false, 38))), "html", null, true);
                yield "\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["course"], "titre", [], "any", false, false, false, 38), "html", null, true);
                yield "\">
                                ";
            } else {
                // line 40
                yield "                                    <img class=\"img-fluid\" src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/default-course.jpg"), "html", null, true);
                yield "\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["course"], "titre", [], "any", false, false, false, 40), "html", null, true);
                yield "\">
                                ";
            }
            // line 42
            yield "                            </div>
                            <div class=\"text-center p-4 pb-0\">
                                <h3 class=\"mb-0\">";
            // line 44
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["course"], "titre", [], "any", false, false, false, 44), "html", null, true);
            yield "</h3>
                                <div class=\"mb-3\">
                                    <small class=\"fa fa-star text-primary\"></small>
                                    <small class=\"fa fa-star text-primary\"></small>
                                    <small class=\"fa fa-star text-primary\"></small>
                                    <small class=\"fa fa-star text-primary\"></small>
                                    <small class=\"fa fa-star text-primary\"></small>
                                </div>
                                <p>";
            // line 52
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["course"], "description", [], "any", false, false, false, 52), "html", null, true);
            yield "</p>
                            </div>
                            <div class=\"d-flex border-top\">
                                <small class=\"flex-fill text-center border-end py-2\"><i class=\"fa fa-user-tie text-primary me-2\"></i>";
            // line 55
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["course"], "instructeur", [], "any", false, false, false, 55), "html", null, true);
            yield "</small>
                                <small class=\"flex-fill text-center border-end py-2\"><i class=\"fa fa-clock text-primary me-2\"></i>";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["course"], "duree", [], "any", false, false, false, 56), "html", null, true);
            yield "</small>
                                <small class=\"flex-fill text-center py-2\"><i class=\"fa fa-user text-primary me-2\"></i>";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["course"], "niveau", [], "any", false, false, false, 57), "html", null, true);
            yield "</small>
                            </div>
                        </div>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['course'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 62
        yield "            </div>
        </div>
    </div>
    <!-- Courses End -->
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "public/categorie_cours/show.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  212 => 62,  201 => 57,  197 => 56,  193 => 55,  187 => 52,  176 => 44,  172 => 42,  164 => 40,  156 => 38,  154 => 37,  149 => 34,  145 => 33,  139 => 30,  122 => 16,  118 => 15,  114 => 14,  108 => 11,  101 => 6,  88 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}{{ category.nom }} - Courses{% endblock %}

{% block content %}
    <!-- Header Start -->
    <div class=\"container-fluid bg-primary py-5 mb-5 page-header\">
        <div class=\"container py-5\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-10 text-center\">
                    <h1 class=\"display-3 text-white animated slideInDown\">{{ category.nom }}</h1>
                    <nav aria-label=\"breadcrumb\">
                        <ol class=\"breadcrumb justify-content-center\">
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"{{ path('app_home') }}\">Home</a></li>
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"{{ path('public_categorie_cours_index') }}\">Categories</a></li>
                            <li class=\"breadcrumb-item text-white active\" aria-current=\"page\">{{ category.nom }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Courses Start -->
    <div class=\"container-xxl py-5\">
        <div class=\"container\">
            <div class=\"text-center wow fadeInUp\" data-wow-delay=\"0.1s\">
                <h6 class=\"section-title bg-white text-center text-primary px-3\">Courses</h6>
                <h1 class=\"mb-5\">{{ category.nom }} Courses</h1>
            </div>
            <div class=\"row g-4 justify-content-center\">
                {% for course in courses %}
                    <div class=\"col-lg-4 col-md-6 wow fadeInUp\" data-wow-delay=\"0.1s\">
                        <div class=\"course-item bg-light\">
                            <div class=\"position-relative overflow-hidden\">
                                {% if course.image %}
                                    <img class=\"img-fluid\" src=\"{{ asset('uploads/courses/' ~ course.image) }}\" alt=\"{{ course.titre }}\">
                                {% else %}
                                    <img class=\"img-fluid\" src=\"{{ asset('img/default-course.jpg') }}\" alt=\"{{ course.titre }}\">
                                {% endif %}
                            </div>
                            <div class=\"text-center p-4 pb-0\">
                                <h3 class=\"mb-0\">{{ course.titre }}</h3>
                                <div class=\"mb-3\">
                                    <small class=\"fa fa-star text-primary\"></small>
                                    <small class=\"fa fa-star text-primary\"></small>
                                    <small class=\"fa fa-star text-primary\"></small>
                                    <small class=\"fa fa-star text-primary\"></small>
                                    <small class=\"fa fa-star text-primary\"></small>
                                </div>
                                <p>{{ course.description }}</p>
                            </div>
                            <div class=\"d-flex border-top\">
                                <small class=\"flex-fill text-center border-end py-2\"><i class=\"fa fa-user-tie text-primary me-2\"></i>{{ course.instructeur }}</small>
                                <small class=\"flex-fill text-center border-end py-2\"><i class=\"fa fa-clock text-primary me-2\"></i>{{ course.duree }}</small>
                                <small class=\"flex-fill text-center py-2\"><i class=\"fa fa-user text-primary me-2\"></i>{{ course.niveau }}</small>
                            </div>
                        </div>
                    </div>
                {% endfor %}
            </div>
        </div>
    </div>
    <!-- Courses End -->
{% endblock %}
", "public/categorie_cours/show.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\public\\categorie_cours\\show.html.twig");
    }
}
