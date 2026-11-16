<?php
declare(strict_types=1);
namespace Ksfraser\FrontAccounting\CRM\Helpdesk\Tests\Unit;
use PHPUnit\Framework\TestCase;
use Ksfraser\FrontAccounting\CRM\Helpdesk\DTO\HelpdeskDTO;
class HelpdeskDtoTest extends TestCase
{
    public function testDtoRoundTripsThroughArray(): void {
        $dto = new HelpdeskDTO(5, 'Login issue', 'Cannot login', 10, 'Sue Jones', 7, 'Kevin Smith', 'high', 'open');
        $arr = $dto->toArray();
        $this->assertSame(5, $arr['case_id']);
        $this->assertSame('Login issue', $arr['title']);
        $this->assertSame('Sue Jones', $arr['person_name']);
        $this->assertSame('Kevin Smith', $arr['assigned_name']);
        $this->assertSame('high', $arr['priority']);
        $this->assertSame('open', $arr['status']);
        $dto2 = HelpdeskDTO::fromArray($arr);
        $this->assertSame($dto->case_id, $dto2->case_id);
        $this->assertSame($dto->title, $dto2->title);
        $this->assertSame($dto->priority, $dto2->priority);
    }
    public function testDisplayLabelUsesTitleAndStatusWhenSet(): void {
        $dto = new HelpdeskDTO(1, 'Login issue', '', 0, '', 0, '', 'high', 'open');
        $this->assertStringContainsString('Login issue', $dto->getDisplayLabel());
        $this->assertStringContainsString('open', $dto->getDisplayLabel());
    }
    public function testDisplayLabelFallsBackToId(): void {
        $dto = new HelpdeskDTO(9, '', '', 0, '', 0, '', 'normal', 'open');
        $this->assertStringContainsString('Helpdesk Case #9', $dto->getDisplayLabel());
    }
}
